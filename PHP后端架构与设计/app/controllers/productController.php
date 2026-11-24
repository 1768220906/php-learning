<?php

require_once __DIR__ . '/../services/productService.php';

class ProductController
{
  private ProductService $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function sendJson(int $statusCode, array $data)
  {

    http_response_code($statusCode);

    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }

  public function index(): void
  {
    // 调用 Service 获取商品
    $products = $this->productService->getProducts();

    $this->sendJson(200, $products);
  }

  public function create()
  {
    // 获取请求体
    $row_data = file_get_contents("php://input");

    // 解构数据
    $data = json_decode($row_data, true);

    /*
      controller层校验客户端有没有按照 API 约定提交数据
      验证内容	示例
      参数是否存在	有没有 name
      参数类型是否正确	price 是否为数字
      参数格式是否正确	JSON 格式是否合法
      参数是否符合接口要求	stock 是否为整数
    */

    // 校验数据格式是否正确
    if (!is_array($data)) {
      throw new InvalidArgumentException("请求 JSON 格式错误");
    }

    if (
      !isset($data['name'], $data['description'], $data['price'], $data['stock'])
      || !is_string($data['name'])
      || !is_string($data['description'])
      || !is_numeric($data['price'])
      || filter_var($data['stock'], FILTER_VALIDATE_INT) === false
    ) {
      throw new InvalidArgumentException("请求参数不合法");
    }

    // 调用service
    $product = $this->productService->createProduct(
      $data["name"],
      $data["description"],
      (float)$data['price'],
      (int)$data['stock']
    );

    $this->sendJson(201, [
      "code" => 201,
      "message" => "商品创建成功",
      "data" => $product
    ]);
  }

  public function show()
  {

    $id = $_GET["id"] ?? null;


    // 验证参数
    if ($id === null || filter_var($id, FILTER_VALIDATE_INT) === false) {

      throw new InvalidArgumentException("商品id不合法");
    }

    // 调用服务
    $product = $this->productService->getProductById((int) $id);

    $this->sendJson(200, [
      "code" => 200,
      "message" => "商品查询成功",
      "data" => $product
    ]);
  }
}
