<?php

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }

//本番環境
// $prod_db = "hatgpt_gs_kadai";
// $prod_host = "mysql643.db.sakura.ne.jp";
// $prod_id = "hatgpt";
// $prod_pw = "qwerty123";

$prod_db = "gs_db_kadai3";
$prod_host = "localhost";
$prod_id = "root";
$prod_pw = "";



//DB接続
function db_conn($prod_db, $prod_host, $prod_id, $prod_pw) {
  try {
      $pdo = new PDO('mysql:dbname='. $prod_db .';charset=utf8;host='. $prod_host, $prod_id, $prod_pw);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
  } catch (PDOException $e) {
      exit('DBConnectError:'.$e->getMessage());
  }
}


//SQLエラー

    function sql_error($stmt){
      $error = $stmt->errorInfo();
      exit("ErrorQuery:" . $error[2]);
  }

//リダイレクト

    function redirect($url) {
        header('Location: ' . $url);
        exit();
    }