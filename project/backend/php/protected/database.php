<?php

try {
    $dbConnection = 'mysql:host=db; dbname=mydb; charset=utf8';
    $dbUserName = 'root';
    $dbPassword = 'password';
    $option = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // try-catch
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // json
    ];
    $db = new PDO(
        $dbConnection,
        $dbUserName,
        $dbPassword,
        $option
    );
} catch (PDOException $ex) {
    echo '{
            "status":0,
            "message":"cannot connect to db",
            "ex": ' . $ex . '
        }';
}

function err($message = 'error', $line = 0)
{
    echo '{
        "status":0,
        "message":"' . $message . '"
        "line":' . $line . '
    }';
    exit;
}
