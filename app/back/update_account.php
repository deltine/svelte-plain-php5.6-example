<?php

header('Context-Type: application/json');

require_once(__DIR__ . '/protected/database.php');

// name
if (!isset($_POST['name'])) {
    err("name missing", __LINE__);
}

if (!strlen($_POST['name']) > 10) {
    err("name max 10 charactor", __LINE__);
}

// picture
// if (!isset($_FILES['picture'])) {
//     err('picture missing', __line__);
// }
// // var_dump($_FILES['picture']);
// $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
// // echo $extension;

// $alloowedExtension = ['png', 'jpg', 'gif'];
// if (!in_array($extension, $alloowedExtension)) {
//     err('picture must be ' . implode(', ', $alloowedExtension));
// }

// if ($_FILES['picture']['size'] > 1000000) {
//     err('picture too big (' . $_FILES['picture']['size'] . ')', __LINE__);
// }

// おまけ
// $uniquePictureName = bin2hex(openssl_random_pseudo_bytes(16));
// $uniquePictureName .= '.' . $extension;
// echo $uniquePictureName;

try {
    $q = $db->prepare('update account set account_name = :name where account_id = :id');
    $q->bindValue(':name', $_POST['name']);
    $q->bindValue(':id', $_POST['id']);
    // $q->bindValue(':email', $_POST['email']);
    // $q->bindValue(':password', $_POST['password']);
    $q->execute();
    if (!$q->rowCount()) {
        err('user not found', __LINE__);
    }
    echo '{"status":1, "message":"user updated"}';
} catch (PDOException $ex) {
    err('error executing query', $ex);
}
