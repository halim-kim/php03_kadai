<?php

require_once('funcs.php');

//1. POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];

//本番環境
// $prod_db = "hatgpt_gs_kadai";
// $prod_host = "mysql643.db.sakura.ne.jp";
// $prod_id = "hatgpt";
// $prod_pw = "qwerty123";

$prod_db = "gs_db_kadai3";
$prod_host = "localhost";
$prod_id = "root";
$prod_pw = "";

//2. DB接続します
db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO
                gs_bm_table( id, name, url, comment, datetime )
                VALUES( NULL, :name, :url, :comment, now() ) ');

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false) {
    sql_error($stmt);
    exit();
} else {

    redirect('select.php');

}