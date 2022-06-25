<?php

header('Context-Type: application/json');

require_once(__DIR__ . '/protected/database.php');

if (!isset($_GET['id'])) {
    err("id missing", __LINE__);
}

if (!ctype_digit($_GET['id'])) {
    err("id not valid", __LINE__);
}

try {
    $q = $db->prepare('select * from account where account_id = :id');
    $q->bindValue(':id', $_GET['id']);
    $q->execute();
    $row = $q->fetchAll();
    if (!$row) {
        err('user not found', __LINE__);
    }
    echo '{"status":1, "data":"' . json_encode($rows) . '"}';
} catch (PDOException $ex) {
    err('error executing query', $ex);
}
