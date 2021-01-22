<?php
// 一日で復活するタスク
$done = 0;

require_once('dbc.php');
$dbh = connect();

// に同じ日のデータがあれば、
function check() {
    require_once('dbc.php');
    $dbh = connect();

    $sql = "SELECT * FROM all_task WHERE create_date = CURDATE() AND type = 3";
    $stmt = $dbh->prepare($sql);
    $status = $stmt->execute();

    if ($status==false) {
        $error = $stmt->errorInfo();
        exit("ErrorMessage:".$error[2]);
    } else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            global $done;
            $done = 1;
        }
    }
    return $done;
}

check();

    function addTask() {
        require_once('dbc.php');
        $dbh = connect();

        if ($done !== 1) {
            $SQL = "INSERT INTO all_task(id, title, text, deadline, create_date, type, requiredTime) VALUES(NULL, :title, :text, sysdate(), sysdate(), '3', '20')";
            $stmt = $dbh->prepare($SQL);
            // 1つ目
            $params = array(':title' => '筋トレ', ':text' => '体幹、逆立ち、プレス、ランニング');
            $STATUS = $stmt->execute($params);

            $params = array(':title' => '情報収集', ':text' => 'Twitter、ニュース、Facebook');
            $STATUS = $stmt->execute($params);

            $params = array(':title' => 'アウトプット', ':text' => 'Twitter、ブログで発信');
            $STATUS = $stmt->execute($params);

            $params = array(':title' => '瞑想', ':text' => '寝起きに瞑想、感謝の時間');
            $STATUS = $stmt->execute($params);

            $params = array(':title' => '涙', ':text' => '感動の動画や話を見る。');
            $STATUS = $stmt->execute($params);

            $params = array(':title' => '読書', ':text' => '好きな本を開く');
            $STATUS = $stmt->execute($params);

            if ($STATUS==false) {
            $error = $stmt->errorInfo();
            exit("ErrorMessage:".$error[2]);
            } else {
            }
        }
    }

addTask();

redirect('index.php');