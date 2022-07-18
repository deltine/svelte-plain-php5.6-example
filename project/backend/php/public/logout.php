<?php

require_once(__DIR__ . '/../protected/env.php');

header("Access-Control-Allow-Origin: " . $APP_ROOT);
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Credentials: true");
header('Context-Type: application/json');

// $requestBodyJson = file_get_contents('php://input');
// $requestBody = json_decode($requestBodyJson, true);
// var_dump($requestBody);

$maxlifetime = 6000;
session_set_cookie_params($maxlifetime, '/; SameSite=None', '', true);

session_start();
unset($_SESSION['bookstore_username']);
// $_SESSION = array();
session_write_close();

$response = array(
    'status' => true,
    'message' => 'user logout.',
);
echo json_encode($response);
