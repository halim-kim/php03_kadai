<?php

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }


//DB接続
  function db_conn(){
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