<?php
require_once('dbc.php');
$dbh = connect();

$userInfo = getUserInfo();
$userId = $userInfo['ID'];

// データ受け取り
$title = $_POST['title'];
$text = $_POST['text'];
$deadline = $_POST['deadline'];
$type = $_POST['type'];
$requiredTime = $_POST['requiredTime'];

// session_start();
// loginCheck();

$sql = "INSERT INTO all_task(id, title, text, deadline, create_date, type, requiredTime, user_id) VALUES(NULL, :title, :text, :deadline, CURDATE(), :type, :requiredTime, :user_id)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $text, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':deadline', $deadline);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':type', $type, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':requiredTime', $requiredTime, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    if ($type == 1) {
        redirect("./short_plan.php");
    } else if ($type == 2) {
        redirect("./midle_plan.php");
    }
}




?>