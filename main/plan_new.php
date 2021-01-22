<?php
require_once('dbc.php');
$dbh = connect();

session_start();
loginCheck();

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

    <style>
        .col-md-7 {
            margin: 0 auto;
        }
    </style>
    <title>Hello, world!</title>
    
</head>

<body class="bg-light">
<div id="header"></div>

    <div class="container ">
    <main>
        <div class="py-5 text-center">
        <h2>Add Task!</h2>
        </div>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Task Detail</h4>
            <form action="./plan_add.php" method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
    
                <!-- <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback">
                    Your username is required.
                    </div>
                </div>
                </div> -->
    
                <div class="col-12">
                <label for="email" class="form-label">Explain <span class="text-muted">(Optional)</span></label>
                <input type="email" name="text" class="form-control" id="email" placeholder="説明">
                <div class="invalid-feedback">
                    Please enter a valid Explain.
                </div>
                </div>
    
                <div class="col-12">
                <label for="address2" class="form-label">期限<span class="text-muted">(Optional)</span></label>
                <input type="date" name="deadline" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>
                
                <div class="col-md-5">
                <br>
                <label for="country" class="form-label">種類</label>
                <select class="form-select" name="type" id="country" required>
                    <option value="">Choose...</option>
                    <option value="1">短期</option>
                    <option value="2">中期</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid country.
                </div>
                </div>
    
                <div class="col-md-4">
                <br>
                <label for="state" class="form-label">制限時間</label>
                <select class="form-select" name="requiredTime" id="state" required>
                    <option value="">Choose...</option>
                    <option value="20">20分</option>
                    <option value="40">40分</option>
                    <option value="60">60分</option>
                </select>
                <div class="invalid-feedback">
                    Please provide a valid state.
                </div>
                </div>

            </div>
    
            <hr class="my-4">
    
            <hr class="my-4">
    
            <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
            </form>
        </div>
        </div>
    </main>
    
    </div>
    
    
        <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
        <script src="form-validation.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>

</html>

