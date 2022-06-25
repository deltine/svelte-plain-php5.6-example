<?php

header('Access-Control-Allow-Origin: *');
header('Context-Type: application/json');

require_once(__DIR__ . '/protected/database.php');

try {
    $q = $db->prepare('select * from account');
    $q->execute();
    $rows = $q->fetchAll();
    echo '{"status":1, "data":' . json_encode($rows) . '}';
} catch (PDOException $ex) {
    err('error executing query', $ex);
}
