<?php
$id = $_GET["id"]; //?id~**を受け取る
$type = $_GET["type"];

require_once("dbc.php");
$dbh = connect();
loginCheck();
$userInfo = getUserInfo();
$userId = $userInfo['ID'];

    $stmt = $dbh->prepare('DELETE FROM all_task WHERE id = :id');
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status == false) {
        sql_error($status);
    } else {
    }

    $stmt = $dbh->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
    $status = $stmt->execute();

    //３．データ表示
    $grades = 0;
    if ($status == false) {
        sql_error($stmt);
    } else {
        while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            global $grades;
            $grades = $r['Grades'];
        }
    }


if ($type == 1) {
    global $grades;
    $grades = $grades + 50;
} else if ($type == 3) {
    global $grades;
    $grades = $grades + 80;
}
var_dump($grades);
// userDB更新
$sql = "UPDATE user SET Grades = :grades WHERE id=:id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':grades', $grades);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $userId);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// gradesDBへ記入
$sql = "INSERT INTO grades(id, user_id, user_grades, date) VALUE(NULL, :id, :grades, sysdate())";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $userId);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':grades', $grades);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// リダイレクト処理
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('../main/index.php');
}


?>

