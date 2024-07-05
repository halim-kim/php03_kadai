<?php
require_once('funcs.php');

//1. POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];
$id = $_POST['id'];

//2. DB接続します
$pdo = db_conn($prod_db, $prod_host, $prod_id, $prod_pw);

//3. データ更新SQL作成
$stmt = $pdo->prepare("
UPDATE
gs_bm_table
SET
name=:name, url=:url, comment=:comment 
WHERE
id=:id"
);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4. データ更新処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
?>