<?php

require_once(__DIR__ . '/../protected/env.php');

header("Access-Control-Allow-Origin: " . $APP_ROOT);
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Credentials: true");
header('Context-Type: application/json');

$requestBodyJson = file_get_contents('php://input');
$requestBody = json_decode($requestBodyJson, true);
// var_dump($requestBody);

$maxlifetime = 6000;
session_set_cookie_params($maxlifetime, '/; SameSite=None', '', true);

session_start();
session_regenerate_id();
// $_SESSION['bookstore_username'] = $_POST["username"];
$_SESSION['bookstore_username'] = $requestBody["username"];
session_write_close();

$response = array(
    'status' => true,
    'message' => 'user successfully authorized.',
    // 'u1' => $_POST["username"],
    'u2' => $requestBody["username"],
    'u3' => $_SESSION['bookstore_username']
);
echo json_encode($response);
