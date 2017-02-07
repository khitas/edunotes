<?php header('Content-type: charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="gr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>myNotes</title>

    <script src="libs/jquery/jquery-2.1.0.js"></script>

    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap-theme.css">
    <script src="libs/bootstrap/dist/js/bootstrap.js"></script>
</head>

<style>
    body {
        padding-top: 20px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 350px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

</style>
<body>

<div class="container">

    <form class="form-signin" role="form" action="index.php" method="post">
        <h2 class="form-signin-heading">Σύνδεση</h2>
        <input type="text" class="form-control" name="username" placeholder="Όνομα Χρήστη" required autofocus>
        <p></p>
        <input type="password" class="form-control" name="password" placeholder="Κωδικός Πρόσβασης" required>
<!--        <label class="checkbox">-->
<!--            <input type="checkbox" value="remember-me"> Remember me-->
<!--        </label>-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Σύνδεση</button>
    </form>

</div>

</body>
</html>