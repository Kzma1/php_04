<?php

function connect() {
    $dsn = 'mysql:dbname=DBG; host=localhost; charset=utf8';
    $username = 'root';
    $password = "root";

    try {
            $dbh = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $e) {
        echo 'DBConnectError'.$e->getMessage();
        exit();
    }

    return $dbh;
}

function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name) {
    header("Location: $file_name");
    exit();
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

// ログインチェク処理 loginCheck()
function loginCheck () {
    session_start();
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id() ) {
        exit('Login Error：再度ログインしてください');
    } else {
        // セキュリティー対策のため、セッションIDを更新する
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

// ユーザー情報
function getUserInfo() {
    session_start();
    $userInfo = array(
        'ID' => $_SESSION['userId'], 
        'Name' => $_SESSION['name'],
        'kanri_flg' => $_SESSION['kanri_flg']
    );

    return $userInfo;
}

?>