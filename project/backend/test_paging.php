<?php

//PDOオブジェクトの生成記述は環境毎に異なるので省略
require_once(__DIR__ . '/protected/database.php');
include_once('Paging.php');

//ページ毎の件数を設定
$row_count = 5;

//テーブル全体の件数を取得
$sql = "SELECT COUNT(*) FROM pref";
$sth = $db->query($sql);
$count = $sth->fetch(PDO::FETCH_COLUMN);

//現在のページを取得 存在しない場合は1とする
$page = 1;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
}
if (!$page) {
    $page = 1;
}

//$pageの数から件数分を表示するSQLクエリを生成 配列で取得
$sql = "SELECT * FROM account";
$sql .= " ORDER BY pref_id LIMIT " . (($page - 1) * $row_count) . ", " . $row_count;
$sth = $pdo->query($sql);
$aryPref = $sth->fetchAll(PDO::FETCH_ASSOC);

//Pagingクラスを生成し、ページングのHTMLを生成
$pageing = new Paging();
$pageing->count = $row_count;
$pageing->setHtml($count);
