<?php

header("Access-Control-Allow-Origin: https://example-app.jp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header('Context-Type: application/json');

require_once(__DIR__ . '/../protected/database.php');
require_once(__DIR__ . '/../protected/logger.php');

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
$pageSize = 5;
if (isset($requestBody['pageSize']) && is_numeric($requestBody['pageSize'])) {
	$pageSize = $requestBody['pageSize'];
}

// ソートキー※account_id等
$sortKey = "";
if (isset($requestBody['sortKey']) && is_string($requestBody['sortKey'])) {
	$sortKey = $requestBody['sortKey'];
}

// ソート順※ascending/descending
$sortDirection = "";
if (isset($requestBody['sortDirection']) && is_string($requestBody['sortDirection'])) {
	$sortDirection = $requestBody['sortDirection'];
}

try {
	$count_sql = "select count(*) from account;";
	// var_dump($db);
	$count_state = $db->query($count_sql);
	// var_dump($count_state);
	$totalItems = $count_state->fetch(PDO::FETCH_COLUMN);

	// $q = $db->prepare('select acc.account_id as id, acc.* from account acc;');
	// $q->execute();
	// $rows = $q->fetchAll();

	$sql = "select acc.account_id as id, acc.* from account acc";

	// ソート
	// $sql_test = $sql;
	if ($sortKey !== "") {
		$sortDir = "asc";
		if ($sortDirection === "descending") {
			$sortDir = "desc";
		}
		$sql .= " order by " . $sortKey . " " . $sortDir;
	}

	// リミット
	$sql .= " limit " . (($page - 1) * $pageSize) . ", " . $pageSize;

	Logger::info($sql);

	$state = $db->query($sql);
	$rows = $state->fetchAll();

	$response = array(
		"status" => true,
		"totalItems" => $totalItems,
		"page" => $page,
		"pageSize" => $pageSize,
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
