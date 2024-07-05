<?php
require_once('funcs.php');

//1. GETデータ取得
$id = $_GET['id'];

//2. DB接続します
$pdo = db_conn($prod_db, $prod_host, $prod_id, $prod_pw);

//3. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4. データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブックマーク編集</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="select.php">データ一覧</a>
        </nav>
    </header>

    <div class="container">
        <form method="post" action="update.php">
            <div class="jumbotron">
                <fieldset>
                    <legend>ブックマーク編集</legend>
                    <label>書籍名：<input type="text" name="name" value="<?= h($result['name']) ?>"></label><br>
                    <label>書籍URL：<input type="text" name="url" value="<?= h($result['url']) ?>"></label><br>
                    <label>書籍コメント：<textarea name="comment" rows="4" cols="40"><?= h($result['comment']) ?></textarea></label><br>
                    <input type="hidden" name="id" value="<?= h($result['id']) ?>">
                    <input type="submit" value="更新">
                </fieldset>
            </div>
        </form>
    </div>
</body>
</html>