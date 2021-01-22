<?php
$id = $_GET["id"];
//1. POSTデータ取得
$title = $_POST['title'];
$text = $_POST['text'];
$deadline = $_POST['deadline'];
$startTime = $_POST['startTime'];
$type = $_POST['type'];
$requiredTime = $_POST['requiredTime'];

//2. DB接続します
require_once("dbc.php");
$dbh = connect();

//３．データ登録SQL作成
$stmt = $dbh->prepare("UPDATE all_task SET title=:title,text=:text,deadline=:deadline,startTime=:startTime,type=:type,requiredTime=:requiredTime WHERE id=:id");
$stmt->bindValue(':title',$title,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text',$text,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':deadline',$deadline);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':startTime', $startTime);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':type',$type,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':requiredTime',$requiredTime,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    var_dump($status);
    if ($type == 1) {
        redirect("./short_plan.php");
    } else if ($type == 2) {
        redirect("./midle_plan.php");
    }
}
