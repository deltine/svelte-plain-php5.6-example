<?php

// header('Access-Control-Allow-Origin: *');
header('Context-Type: application/json');

$requestBodyJson = file_get_contents('php://input');
$requestBody = json_decode($requestBodyJson, true);

session_start();

// if (isset($_SESSION["bookstore_username"]) && $_SESSION["bookstore_username"] == $_POST['username']) {
if (isset($_SESSION["bookstore_username"]) && $_SESSION["bookstore_username"] == $requestBody["username"]) {
    $response = array('status' => true, 'message' => "user is logged in.");
    echo json_encode($response);
} else {
    $response = array('status' => false, 'message' => "user is not logged in.");
    echo json_encode($response);
}
