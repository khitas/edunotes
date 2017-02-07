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

        $("button").click(function(){
            if ( $(this).attr("data-value") == "btnDelete" ){
                $(this).closest('tr').remove();
                $.ajax({
                    url: "commands/lessons/delete-lesson.php",
                    type: 'post',
                    data: {lesson_id: $(this).val() },
                    success: function(response){
                        //
                    },
                    error: function(){
                        $('#myModal').modal({
                            keyboard: true
                        });
                    },
                    complete: function() {
                    }
                })
            }
            else if ( $(this).attr("data-value") == "btnView" ){
               $.ajax({
                    url: "commands/lessons/view-lesson.php",
                    type: 'post',
                    data: {lesson_id: $(this).val() },
                    success: function(response){
                        window.location.href = "view.php";
                    },
                    error: function(){
                        $('#myModal').modal({
                            keyboard: true
                        });
                    },
                    complete: function() {
                    }
                })
            }
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
            <h2 class="page-header">Ιστορικό</h2>
<!--            <p class="lead" id="lblTitle">Ιστορικό Ασκήσεων</p>-->
        </div>

        <div class="row">
            <div class="panel panel-default" >
                <!-- Default panel contents -->
<!--                <div class="panel-heading">Panel heading</div>-->

                <!-- Table -->
                <table class="table" id="tableid">
                    <thead>
                    <tr>
                        <th colspan="2"></th>
                        <th>#</th>
                        <th>Ημ. Ώρα</th>
                        <th>Νότες</th>
                        <th>Σωστές</th>
                        <th>Επιτυχία</th>
                        <th>Βαθμοί</th>
                    </tr>
                    </thead>
                    <tbody>
<?php

$sql = "SELECT
          lesson_id,
          user_id,
          start_at,
          total_notes,
          correct_notes,
          total_score
        FROM lessons
        WHERE user_id = ".$db->quote( $User["user_id"] )."
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
                        <td><button type="button" value="<?php echo $row["lesson_id"]; ?>" data-value="btnView" class="btn btn-default btn-lg btn-block glyphicon glyphicon-music"></button></td>
                        <td><button type="button" value="<?php echo $row["lesson_id"]; ?>" data-value="btnDelete" class="btn btn-default btn-lg btn-block glyphicon glyphicon-trash"></button></td>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $row["start_at"]; ?></td>
                        <td><?php echo $row["total_notes"] ? $row["total_notes"] : 0; ?></td>
                        <td><?php echo $row["correct_notes"] ? $row["correct_notes"] : 0; ?></td>
                        <td><?php echo $percent."%"; ?></td>
                        <td><?php echo $row["total_score"] ? $row["total_score"] : 0; ?></td>
                    </tr>
<?php
}
?>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="row" id="grpStart">
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnStart" class="btn btn-primary btn-lg btn-block">Ασκήσεις</button>
                </div>
            </div><br>
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnReturn" class="btn btn-default btn-lg btn-block">Επιστροφή</button>
                </div>
            </div>
        </div>
    </div>

</div>


<div role="main" class="col-md-2"></div>

</body>
</html>