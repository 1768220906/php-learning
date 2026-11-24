<?php

require_once __DIR__ . '/../database.php';

/* 查询 */

// 模拟用户搜索关键词
// $keyword = '机械键盘';
// $keyword = '键盘';
// $minPrice = 500;
// $maxPrice = 1000;

$keyword = '键盘';
$minPrice = 100;
$maxPrice = null;


// 基础
// $sql = '
//     SELECT id, name, price, stock
//     FROM products
//     WHERE name = :keyword
// ';

// 模糊
// $sql = '
//     SELECT id, name, price, stock
//     FROM products
//     WHERE name LIKE :keyword
// ';

// 多条件
// $sql = '
//     SELECT id, name, price, stock
//     FROM products
//     WHERE name LIKE :keyword
//       AND price >= :minPrice
//       AND price <= :maxPrice
// ';

// 组合条件，动态构建where
// function generateSQL(string $keyword, int|null $minPrice, int|null $maxPrice)
// {
//   // 1. 准备条件数组和参数数组
//   $conditions = [];
//   $params = [];

//   // 2. 根据用户输入动态添加条件
//   if ($keyword !== '') {
//     $conditions[] = 'name LIKE :keyword';
//     $params['keyword'] = '%' . $keyword . '%';
//   }

//   if ($minPrice !== null) {
//     $conditions[] = 'price >= :minPrice';
//     $params['minPrice'] = $minPrice;
//   }

//   if ($maxPrice !== null) {
//     $conditions[] = 'price <= :maxPrice';
//     $params['maxPrice'] = $maxPrice;
//   }

//   // 3. 组合 SQL
//   $sql = '
//     SELECT id, name, price, stock
//     FROM products
// ';

//   if (!empty($conditions)) {
//     $sql .= ' WHERE ' . implode(' AND ', $conditions);
//   }
//   return [
//     "sql" => $sql,
//     "params" => $params
//   ];
// }


// $info = generateSQL($keyword, $minPrice, $maxPrice);

// $stmt = $pdo->prepare($info["sql"]);

// $stmt->execute($info["params"]);

// $result = $stmt->fetchAll();

// print_r($result);


/* 分页 */
/* 
关键字	作用
LIMIT 10	最多返回 10 条
OFFSET 0	跳过前 0 条
*/

// $page = 2;
// $pageSize = 10;

// $offset = ($page - 1) * $pageSize;

// $sql = '
//     SELECT id, name, price, stock
//     FROM products
//     ORDER BY id
//     LIMIT :pageSize
//     OFFSET :offset
// ';

// $stmt = $pdo->prepare($sql);

// $stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
// $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

// $stmt->execute();

// $result = $stmt->fetchAll();

// print_r($result);

/* COUNT(*) 查询总数 */

// $sql = 'SELECT COUNT(*) FROM products';

// $stmt = $pdo->query($sql);

// $total = $stmt->fetchColumn();

// echo "商品总数：{$total}\n";

// $pageSize = 10;

// $totalPages = (int) ceil($total / $pageSize);

// echo "总页数：{$totalPages}\n";


// 模拟用户请求参数
$keyword = '键盘';
$minPrice = 100;
$maxPrice = null;

$page = 1;
$pageSize = 10;

// 1. 动态构建查询条件
$conditions = [];
$params = [];

if ($keyword !== '') {
  $conditions[] = 'name LIKE :keyword';
  $params['keyword'] = '%' . $keyword . '%';
}

if ($minPrice !== null) {
  $conditions[] = 'price >= :minPrice';
  $params['minPrice'] = $minPrice;
}

if ($maxPrice !== null) {
  $conditions[] = 'price <= :maxPrice';
  $params['maxPrice'] = $maxPrice;
}

// 2. 构建 WHERE 子句
$whereSql = '';

if (!empty($conditions)) {
  $whereSql = ' WHERE ' . implode(' AND ', $conditions);
}

// 3. 查询符合条件的总记录数
$countSql = 'SELECT COUNT(*) FROM products' . $whereSql;

$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);

$total = (int) $countStmt->fetchColumn();

// 4. 计算分页信息
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

// 绑定搜索条件
foreach ($params as $key => $value) {
  $stmt->bindValue(':' . $key, $value);
}

// 分页参数明确绑定整数
$stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();

$result = $stmt->fetchAll();

// 6. 输出结果
echo "商品总数：{$total}\n";
echo "当前页：{$page}\n";
echo "每页数量：{$pageSize}\n";
echo "总页数：{$totalPages}\n";

print_r($result);
