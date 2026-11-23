<?php

// response header
header('Content-Type: application/json; charset=utf-8');

// params
$name = $_GET['name'] ?? null;
$age = $_GET['age'] ?? null;

// request header
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? null;
$requestUri = $_SERVER['REQUEST_URI'] ?? null;
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
$acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;

// body
// x-www-form-urlencoded 自动解析
$gender = $_POST["gender"] ?? null;
$height = $_POST["height"] ?? null;
// application/json
$rawBody = file_get_contents('php://input');
$jsonData = json_decode($rawBody, true);

echo json_encode([
  'requestMethod' => $requestMethod,
  'requestUri' => $requestUri,
  'name' => $name,
  'age' => $age,
  "userAgent" => $userAgent,
  "acceptLang" => $acceptLang,
  "gender" => $gender,
  "height" => $height,
  "jsonData" => $jsonData
]);
