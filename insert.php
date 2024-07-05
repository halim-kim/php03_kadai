<?php
require_once('funcs.php');

//1. POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];


//2. DB接続します
$pdo = db_conn($prod_db, $prod_host, $prod_id, $prod_pw);

//３．データ登録SQL作成
$stmt = $pdo->prepare(
    'INSERT INTO
                gs_bm_table( 
                id, name, url, comment, datetime) 
                
    VALUES(
                NULL, :name, :url, :comment, now() ) '
                );

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}