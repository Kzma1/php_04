<?php
    require_once('../main/dbc.php');
    connect();
    $dbh = connect();

    session_start();
    $mail = $_POST['mail'];
    $lpw = $_POST['pass'];



    // メールアドレスで一致するものを検索
    $sql = "SELECT * FROM user WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $status = $stmt->execute();

    if($status==false){
        sql_error($stmt);
    }

    $val = $stmt->fetch();         //1レコードだけ取得する方法

    //5. 該当レコードがあればSESSIONに値を代入
//if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
if (password_verify($_POST['pass'], $val['pass'])) {// login_formから来た
    //Login成功時
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];
    $_SESSION['userId'] = $val['id'];
    // ユーザーIDを保存する処理（dbcへ記載）
    getUserInfo();
    header('Location: ../main/daily_task.php');
}else{
    //Login失敗時(Logout経由)
    header('Location: login_form.php');
    // ログイン失敗しましたを表示する
}

exit();

?>
