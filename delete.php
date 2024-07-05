<?php
require_once('funcs.php');

//1. GETデータ取得
$id = $_GET['id'];

//2. DB接続します
$pdo = db_conn($prod_db, $prod_host, $prod_id, $prod_pw);

//3. データ削除SQL作成
$stmt = $pdo->prepare(
    "DELETE FROM gs_bm_table WHERE id=:id"
);

$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4. データ削除処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
?>