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

        $("#btnLessons").click(function(){
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
            <h2 class="page-header">Ανάλυση Άσκησης</h2>
<!--            <p class="lead" id="lblTitle">Ιστορικό Ασκήσεων</p>-->
        </div>

        <div class="row">
            <div class="panel panel-default">
                <!-- Default panel contents -->
<!--                <div class="panel-heading">Panel heading</div>-->

                <!-- Table -->
                <table class="table" id="tableid">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ημερομηνία/Ώρα</th>
                        <th>Ερώτηση</th>
                        <th>Απάντηση</th>
                        <th>Αποτέλεσμα</th>
                        <th>Διαθέσιμος Χρόνος</th>
                        <th>Χρόνος Απάντησης</th>
                        <th>Βαθμοί</th>
                    </tr>
                    </thead>
                    <tbody>
<?php

$lesson_id = $_SESSION["View"]["lesson_id"];

$sql = "SELECT
          lesson_note_id,
          lesson_notes.lesson_id,
          lesson_notes.note_type_id,
          question_note_types.name as question_note_type_name,
          question_note_types.fullname as question_note_type_fullname,
          lesson_notes.answer_note_type_id,
          answer_note_types.name as answer_note_type_name,
          answer_note_types.fullname as answer_note_type_fullname,
          lesson_notes.start_at,
          secs_to_solve,
          secs_to_find,
          score
        FROM lesson_notes
        LEFT JOIN lessons ON lesson_notes.lesson_id = lessons.lesson_id
        LEFT JOIN note_types as question_note_types ON lesson_notes.note_type_id = question_note_types.note_type_id
        LEFT JOIN note_types as answer_note_types ON lesson_notes.answer_note_type_id = answer_note_types.note_type_id
        WHERE user_id = ".$db->quote( $User["user_id"] )." AND lessons.lesson_id = ".$db->quote( $lesson_id )."
        ORDER BY start_at DESC";
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$counter = 0;
foreach($rows as $row)
{
    $counter ++;
    $percent = round($row["total_notes"] ? ($row["correct_notes"] / $row["total_notes"]) * 100 : 0);
?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $row["start_at"]; ?></td>
                        <td><?php echo $row["question_note_type_name"]." | ".$row["question_note_type_fullname"]; ?></td>
                        <td><?php echo $row["answer_note_type_name"]." | ".$row["answer_note_type_fullname"]; ?></td>
                        <td><?php echo $row["note_type_id"] == $row["answer_note_type_id"] ? "<font color=green>ΣΩΣΤΟ</font>" : "<font color=red>ΛΑΘΟΣ</font>"; ?></td>
                        <td><?php echo $row["secs_to_solve"]; ?></td>
                        <td><?php echo $row["secs_to_find"]; ?></td>
                        <td><?php echo $row["score"]; ?></td>
                    </tr>
<?php
}
?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <div class="row" id="grpStart">
        <div class="btn-group-justified">
            <div class="btn-group">
                <button type="button" id="btnHistory" class="btn btn-primary btn-lg btn-block">Ιστορικό</button>
            </div>
        </div><br>
        <div class="btn-group-justified">
            <div class="btn-group">
                <button type="button" id="btnLessons" class="btn btn-default btn-lg btn-block">Ασκήσεις</button>
            </div>
        </div><br>
        <div class="btn-group-justified">
            <div class="btn-group">
                <button type="button" id="btnReturn" class="btn btn-default btn-lg btn-block">Επιστροφή</button>
            </div>
        </div>
    </div>

    <br><br>
</div>


<div role="main" class="col-md-2"></div>

</body>
</html>