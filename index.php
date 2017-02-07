<?php include "includes/settings.php"; ?>
<?php include "includes/authentication.php"; ?>
<!DOCTYPE html>
<html lang="gr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>myNotes</title>

    <script src="libs/jquery/jquery-2.1.0.js"></script>

    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap-theme.css">
    <script src="libs/bootstrap/dist/js/bootstrap.js"></script>

    <link rel="stylesheet" href="libs/switch/build/css/bootstrap3/bootstrap-switch.css">
    <script src="libs/switch/build/js/bootstrap-switch.js"></script>
</head>

<script>
</script>

<style>
    body {
        padding: 0px 20px 20px 20px;
        /*background-color: #eee;*/
    }
</style>

<body>

<div role="main" class="col-md-2"></div>

<div role="main" class="col-md-8">

    <div class="bs-docs-section">

        <div class="row">
            <h2 class="page-header">Μουσικές Νότες</h2>
            <p class="lead" id="lblTitle">Επιλέξτε μία από τις παρακάτω κατηγορίες</p>
        </div>

        <div class="row">
            <div class="list-group">
                <a href="lessons.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Ασκήσεις</h4>
                    <p class="list-group-item-text">Εκπαιδευτικές ασκήσεις πάνω στις μουσικές νότες</p>
                </a>
                <a href="history.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Ιστορικό</h4>
                    <p class="list-group-item-text">Αποτελέσματα όλων των ασκήσεων</p>
                </a>
                <a href="notes.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Νότες</h4>
                    <p class="list-group-item-text">Οι νότες του μουσικού πενταγράμμου</p>
                </a>
                <a href="settings.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Ρυθμίσεις</h4>
                    <p class="list-group-item-text">Καθορίστε τις ρυθμίσεις της εφαρμογής</p>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="list-group">
                <a href="logout.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Έξοδος</h4>
                    <p class="list-group-item-text">Έξοδος από την εφαρμογή</p>
                </a>
            </div>
        </div>

    </div>

</div>


<div role="main" class="col-md-2"></div>

</body>
</html>