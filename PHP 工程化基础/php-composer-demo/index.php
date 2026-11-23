
<?php

use FFI\Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\NetworkTimeoutException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\Timeout;

require __DIR__ . '/vendor/autoload.php';

/* 基础引入 */
// require __DIR__ . "/src/User.php";

// $user = new App\User('张三', 25);

// echo $user->introduce();

// $product = new App\Product();
// echo $product->getName();


/* curl 请求 */
$baseUrl = 'https://httpbin.org/';
$client = new \GuzzleHttp\Client();

/* get */
// $response = $client->get('https://httpbin.org/get');

// $statusCode = $response->getStatusCode();

// echo $statusCode;

// $body = $response->getBody();

// echo $body;

/* post */
// $postUrl = $baseUrl . 'post';
// $response = $client->post($postUrl, [
//   "json" => [
//     "name" => "张三",
//     "age" => 15,
//   ],
// ]);

// $statusCode = $response->getStatusCode();

// echo $statusCode . PHP_EOL;

// $body = $response->getBody();

// echo $body . PHP_EOL;

/* custom header */
// $headerUrl = $baseUrl . "headers";
// $response = $client->get($headerUrl, [
//   "headers" => [
//     "Authorization" => "Bearer test-token",
//     "X-App-Version" => "1.0.0"
//   ]
// ]);

// $statusCode = $response->getStatusCode();

// echo $statusCode . PHP_EOL;

// $body = $response->getBody();

// echo $body . PHP_EOL;

/* timeout */
// try {
//   //code...  
//   $response = $client->get($baseUrl . 'delay/10', [
//     "timeout" => 3,
//     "connect_timeout" => 2,
//   ]);
//   $statusCode = $response->getStatusCode();
//   echo $statusCode . PHP_EOL;
// } catch (NetworkTimeoutException $error) {
//   //throw $th;
//   echo "请求超时" . $error->getMessage();
// } catch (ConnectException $error) {
//   echo "连接失败" . $error->getMessage();
// } catch (Exception $error) {
//   echo "其他失败" . $error->getMessage();
// }

/* error */
// try {
//   //code...
//   $response = $client->get($baseUrl . 'status/500');
//   $statusCode = $response->getStatusCode();
//   echo "请求成功：" . $response->getStatusCode();
// } catch (NetworkTimeoutException $err) {
//   //throw $th;
//   echo $err->getMessage();
// } catch (ClientException $err) {
//   echo $err->getMessage();
// } catch (ServerException $err) {
//   echo "服务器错误：" . $err->getMessage();
// }
