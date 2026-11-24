<?php

require_once __DIR__ . '/../database.php';

// 设置响应格式为 JSON
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':

    $keyword = trim($_GET['keyword'] ?? '');

    $page = (int) ($_GET['page'] ?? 1);
    $pageSize = (int) ($_GET['pageSize'] ?? 10);

    // 基础输入校验
    if ($page < 1 || $pageSize < 1 || $pageSize > 100) {
      http_response_code(400);

      echo json_encode([
        'success' => false,
        'message' => '分页参数不合法'
      ], JSON_UNESCAPED_UNICODE);

      exit;
    }

    // 1. 构建搜索条件
    $conditions = [];
    $params = [];

    if ($keyword !== '') {
      $conditions[] = 'name LIKE :keyword';
      $params['keyword'] = '%' . $keyword . '%';
    }

    // 2. 构建 WHERE 子句
    $whereSql = '';

    if (!empty($conditions)) {
      $whereSql = ' WHERE ' . implode(' AND ', $conditions);
    }

    // 3. 查询总数
    $countSql = 'SELECT COUNT(*) FROM products' . $whereSql;

    $countStmt = $pdo->prepare($countSql);
    $countStmt->execute($params);

    $total = (int) $countStmt->fetchColumn();

    // 4. 计算分页
    $totalPages = (int) ceil($total / $pageSize);
    $offset = ($page - 1) * $pageSize;

    // 5. 查询当前页商品
    $sql = '
    SELECT id, name, price, stock
    FROM products
' . $whereSql . '
    ORDER BY id
    LIMIT :pageSize
    OFFSET :offset
';

    $stmt = $pdo->prepare($sql);

    foreach ($params as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    $stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    $products = $stmt->fetchAll();

    // 返回 JSON
    echo json_encode([
      'success' => true,
      'data' => $products,
      'pagination' => [
        'total' => $total,
        'page' => $page,
        'pageSize' => $pageSize,
        'totalPages' => $totalPages
      ]
    ], JSON_UNESCAPED_UNICODE);
    break;
  case 'POST':
    $rawBody = file_get_contents('php://input');
    $data = json_decode($rawBody, true);

    if (!is_array($data)) {
      http_response_code(400);

      echo json_encode([
        'success' => false,
        'message' => '请求数据格式不正确'
      ], JSON_UNESCAPED_UNICODE);

      exit;
    }

    $name = trim($data['name'] ?? '');
    $price = $data['price'] ?? null;
    $stock = $data['stock'] ?? null;

    if ($name === '' || !is_numeric($price) || !is_numeric($stock)) {
      http_response_code(400);

      echo json_encode([
        'success' => false,
        'message' => '商品参数不合法'
      ], JSON_UNESCAPED_UNICODE);

      exit;
    }

    $sql = '
        INSERT INTO products (name, price, stock)
        VALUES (:name, :price, :stock)
        RETURNING id, name, price, stock
    ';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'name' => $name,
      'price' => $price,
      'stock' => $stock
    ]);

    $product = $stmt->fetch();

    http_response_code(201);

    echo json_encode([
      'success' => true,
      'message' => '商品创建成功',
      'data' => $product
    ], JSON_UNESCAPED_UNICODE);
    break;

  // 不再单独实现 PUT 和 DELETE，整体流程和 GET、POST 类似

  default:
    # code...
    break;
}
