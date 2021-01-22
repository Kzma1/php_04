<?php
// DB(allTask)から受け取ったデータを、resultに入れて表示する※いつも通り
require_once('dbc.php');
$dbh = connect();

$userInfo = getUserInfo();
$userId = $userInfo['ID'];

loginCheck();

$stmt = $dbh->prepare("SELECT * FROM all_task WHERE type = '1' AND user_id = :user_id");
$stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class="col">';
        $view .= '<div class="card shadow-sm">';
        $view .= '<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">' . $r['title'] .'</text></svg>';
        $view .= '<div class="card-body">';
        $view .= '<p class="card-text">' . $r['text'] . '</p>';
        $view .= '<div class="d-flex justify-content-between align-items-center">';

        $view .= '<div class="btn-group">';
        $view .= '<button type="button" class="btn btn-sm btn-outline-secondary">';
        $view .= '<a href="grades_update.php?id=' . $r["id"] .'&type=' . $r['type']  .  '">タスク開始</button>';

        $view .= '<button type="button" class="btn btn-sm btn-outline-secondary">';
        $view .= '<a href="plan_edit.php?id=' . $r["id"] . '">Edit</button>';

        $view .= '</div>';
        $view .= '<small class="text-muted">' . $r['requiredTime'] . 'min' . '</small>';
        $view .= '</div></div></div></div>';
    }
}

// タスクを重要度などをもとに、大きさ並び替える
// その他ソート機能もあればOK


?>

<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

            <!-- 共通header読み込み -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <script>
    $(function() {
        $("#header").load("header.php");
    });
    </script>

    <title>Hello, world!</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
    </head>

<body>        
    <div id="header">
    
    </div>
    
        <main>
    
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">短期目標</h1>
                <p class="lead text-muted">
                </p>
                <p>
                <a href="./index.php" class="btn btn-primary my-2">TOP</a>
                <a href="./midle_plan.php" class="btn btn-secondary my-2">中期目標</a>
                </p>
            </div>
            </div>
        </section>
    
        <div class="album py-5 bg-light">
            <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            <?= $view ?>
            </div>
            </div>
        </div>
    
        </main>    
    
            <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
            


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

