<?php

header('Access-Control-Allow-Origin: *');
header('Context-Type: application/json');

require_once(__DIR__ . '/protected/database.php');

// POSTリクエスト取得
$requestBodyJson = file_get_contents('php://input');
$requestBody = json_decode($requestBodyJson, true);
// echo json_encode(array($requestBody));
// exit;

//現在のページ※存在しない場合は1とする
$page = 1;
if (isset($requestBody['page']) && is_numeric($requestBody['page'])) {
	$page = $requestBody['page'];
}

// ページサイズ※存在しない場合は5とする
$pageSizes = 5;
if (isset($requestBody['pageSizes']) && is_numeric($requestBody['pageSizes'])) {
	$pageSizes = $requestBody['pageSizes'];
}

// ソートキー
$sortKey = "account_id";
if (isset($requestBody['account_id']) && is_numeric($requestBody['account_id'])) {
	$sortKey = $requestBody['account_id'];
}

// ソート順※ascending/descending
$sortDirection = "ascending";
if (isset($requestBody['sortDirection']) && is_string($requestBody['sortDirection'])) {
	$sortDirection = $requestBody['sortDirection'];
}

try {
	$count_sql = "select count(*) from account;";
	$count_state = $db->query($count_sql);
	$count_result = $count_state->fetch(PDO::FETCH_COLUMN);

	// $q = $db->prepare('select acc.account_id as id, acc.* from account acc;');
	// $q->execute();
	// $rows = $q->fetchAll();

	$sql = "select * from account";
	$sql .= " order by " . $sortKey . " limit " . (($page - 1) * $pageSizes) . ", " . $pageSizes;
	$state = $db->query($sql);
	$rows = $state->fetchAll();

	$response = array(
		"status" => true,
		"count" => $count_result,
		"page" => $page,
		"pageSizes" => $pageSizes,
		"sortKey" => $sortKey,
		"sortDirection" => $sortDirection,
		"data" => $rows
	);
	echo json_encode($response);

	// echo '{"status":1, "data":' . json_encode($rows) . '}';
} catch (PDOException $ex) {
	echo '{"status":2}';
	err('error executing query', $ex);
}
