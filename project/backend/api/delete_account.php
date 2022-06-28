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
    $q = $db->prepare('delete from account where account_id = :id');
    $q->bindValue(':id', $_GET['id']);
    $q->execute();
    if (!$q->rowCount()) {
        err('user not found', __LINE__);
    }
    echo '{"status":1, "message":"user deleted"}';
} catch (PDOException $ex) {
    err('error executing query', $ex);
}
