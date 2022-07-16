<?php

// header('Access-Control-Allow-Origin: *');
header('Context-Type: application/json');

$requestBodyJson = file_get_contents('php://input');
$requestBody = json_decode($requestBodyJson, true);
// var_dump($requestBody);

session_start();
session_regenerate_id();
// $_SESSION['bookstore_username'] = $_POST["username"];
$_SESSION['bookstore_username'] = $requestBody["username"];
session_write_close();

$response = array(
    'status' => true,
    'message' => 'user successfully authorized.',
    'data' => $row,
    'u1' => $_POST["username"],
    'u2' => $requestBody["username"],
    'bu' => $_SESSION['bookstore_username']
);
echo json_encode($response);
