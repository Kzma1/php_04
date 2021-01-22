<?php
require_once('dbc.php');
$dbh = connect();

loginCheck();
$userInfo = getUserInfo();
$userId = $userInfo['ID'];

// DBのGradesの遷移をグラフで表示する
// DB(grades)からユーザーごとのデータを、最新6つとってくる
$grades_transition= [];
$VIEW = "";

    require_once('dbc.php');
    $dbh = connect();
    // WHEREが機能しなかった
    $stmt = $dbh->prepare("SELECT * FROM grades WHERE user_id = :user_id");
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute();

    if ($status == false) {
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        global $grades_transition;
        global $VIEW;
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($grades_transition, $result['user_grades']);
            $VIEW .=
                '<tr><td>' .  h($result['date']) . '</td><td>' . h($result['user_grades']) . 
                '</td></tr>';
        }
    }

$dataCount = count($grades_transition);

$grades_transition0 = $grades_transition[$dataCount - 1];
$grades_transition1 = $grades_transition[$dataCount - 2];
$grades_transition2 = $grades_transition[$dataCount - 3];
$grades_transition3 = $grades_transition[$dataCount - 4];
$grades_transition4 = $grades_transition[$dataCount - 5];
$grades_transition5 = $grades_transition[$dataCount - 6];
$grades_transition6 = $grades_transition[$dataCount - 7];

?>


<!doctype html>
<html lang="ja" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    
    <!-- 共通パーツ読み込み -->
    <script>
        $(function() {
            $("#header").load("header.php");
        });
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style>
        .ml-sm-auto {
            margin: 0 auto;
        }
    </style>

</head>

<body >
<div id="header"></div>

<div class="container-fluid">
<div class="row">

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <!-- <h1 class="h2">Dashboard</h1> -->
                <h1 class="h2">Grades</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button> -->
                        <button type="button" class="btn btn-sm btn-outline-secondary">共有</button>
                        <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
                        <button type="button" class="btn btn-sm btn-outline-secondary">出力</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        <!-- This week -->
                        今週
                    </button>
                </div>
            </div>

            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

            <!-- <h2>Section title</h2> -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead><tr><th>年月日</th><th>Grades</th></tr></thead>
                <tbody><?= $VIEW ?></tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: ["6ヶ月前", "5ヶ月前", "4ヶ月前", "3ヶ月前", "2ヶ月前", "1ヶ月前", "当月"],
        datasets: [{
            data: [<?= $grades_transition0 ?>, <?= $grades_transition1 ?>, <?= $grades_transition2 ?>, <?= $grades_transition3 ?>, <?= $grades_transition4 ?>, <?= $grades_transition5 ?>, <?= $grades_transition6 ?>],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
        }]
        },
        options: {
        scales: {
            yAxes: [{
            ticks: {
                beginAtZero: false
            }
            }]
        },
        legend: {
            display: false,
        }
        }
    });
</script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</body>
</html>
