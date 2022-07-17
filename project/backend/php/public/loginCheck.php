<?php

header("Access-Control-Allow-Origin: https://example-app.jp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Access-Control-Allow-Credentials: true");
header('Context-Type: application/json');

$requestBodyJson = file_get_contents('php://input');
$requestBody = json_decode($requestBodyJson, true);

$maxlifetime = 6000;
session_set_cookie_params($maxlifetime, '/; SameSite=None', '', true);
session_start();

if (isset($_SESSION["bookstore_username"]) && $_SESSION["bookstore_username"] == $requestBody["username"]) {
    $response = array('status' => true, 'message' => "user is logged in.", "u1" => $requestBody["username"], "u2" => $_SESSION["bookstore_username"]);
    echo json_encode($response);
} else {
    $response = array('status' => false, 'message' => "user is not logged in.", "u1" => $requestBody["username"], "u2" => $_SESSION["bookstore_username"]);
    echo json_encode($response);
}
