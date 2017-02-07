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
    $(document).ready(function(){

        $("#btnReturn").click(function(){
            window.location.href = "index.php";
        });

        $("#btnStart").click(function(){
            window.location.href = "lessons.php";
        });

        $("#btnHistory").click(function(){
            window.location.href = "history.php";
        });

    });
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
            <h2 class="page-header">Αποτελέσματα</h2>
<!--            <p class="lead" id="lblTitle">Αποτελέσματα</p>-->
        </div>

<?php

$lesson_id = $_SESSION["Lessons"]["Notes"]["lesson_id"];

$sql = "SELECT
          lesson_id,
          user_id,
          start_at,
          total_notes,
          correct_notes,
          total_score
        FROM lessons
        WHERE lesson_id = ".$db->quote( $lesson_id );
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row = $rows[ 0 ];

$percent = round($row["total_notes"] ? ($row["correct_notes"] / $row["total_notes"]) * 100 : 0);
?>
        <div class="row">
            <ul class="list-group">
                <li class="list-group-item">Ημερομηνία / Ώρα : <strong><?php echo $row["start_at"]; ?></strong></li>
                <li class="list-group-item">Νότες : <strong><?php echo $row["total_notes"] ? $row["total_notes"] : 0; ?></strong></li>
                <li class="list-group-item">Σωστές : <strong><?php echo $row["correct_notes"] ? $row["correct_notes"] : 0; ?></strong></li>
                <li class="list-group-item">Επιτυχία : <strong><?php echo $percent."%"; ?></strong></li>
                <li class="list-group-item">Βαθμοί : <strong><?php echo $row["total_score"] ? $row["total_score"] : 0; ?></strong></li>
            </ul>
        </div>

    <div class="row" id="grpStart">
        <div class="btn-group-justified">
            <div class="btn-group">
                <button type="button" id="btnStart" class="btn btn-primary btn-lg btn-block">Ασκήσεις</button>
            </div>
        </div><br>
        <div class="btn-group-justified">
            <div class="btn-group">
                <button type="button" id="btnHistory" class="btn btn-default btn-lg btn-block">Ιστορικό</button>
            </div>
        </div><br>
        <div class="btn-group-justified">
            <div class="btn-group">
                <button type="button" id="btnReturn" class="btn btn-default btn-lg btn-block">Επιστροφή</button>
            </div>
        </div>
    </div>

</div>


<div role="main" class="col-md-2"></div>

</body>
</html>