<?php

header('Access-Control-Allow-Origin: *');
header('Context-Type: application/json');

require_once(__DIR__ . '/protected/database.php');

try {
    $q = $db->prepare('select acc.account_id as id, acc.* from account acc;');
    $q->execute();
    $rows = $q->fetchAll();
    echo '{"status":1, "data":' . json_encode($rows) . '}';
} catch (PDOException $ex) {
    echo '{"status":2}';
    err('error executing query', $ex);
}
