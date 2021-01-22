<?php
    require_once('../main/dbc.php');
    connect();
    $dbh = connect();

    session_start();
    $_SESSION['pass'] = $_POST['pass'];
    $_SESSION['mail'] = $_POST['mail'];

    //フォームからの値をそれぞれ変数に代入
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $kanri_flg = $_POST['Authority'];

    //フォームに入力されたmailがすでに登録されていないかチェック
    $sql = "SELECT * FROM user WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($member['mail'] === $mail) {
        $msg = '同じメールアドレスが存在します。';
        $link = '<a href="./signup.php">戻る</a>';
    } else {
        //登録されていなければinsert 
        $sql = "INSERT INTO user(id, name, mail, pass, kanri_flg, Grades) VALUES (NULL, :name, :mail, :pass, :kanri_flg, 0)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);
        $status = $stmt->execute();

        if($status==false){
            //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
            $error = $stmt->errorInfo();
            exit("ErrorMessage:".$error[2]);
        } else {
            $sql = "SELECT * FROM user WHERE mail = :mail";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':mail', $mail);
            $stmt->execute();
            $member = $stmt->fetch(PDO::FETCH_ASSOC);
            $msg = '会員登録が完了しました';
            $_SESSION['id'] = $member['id'];
            $_SESSION['name'] = $member['name'];
            // ログインに飛ぶように処理を統一する？
            $link = '<a href="../main/index.php">ホーム</a>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
</body>
</html>