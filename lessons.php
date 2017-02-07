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
        $("#grpNotes").hide();
        $("#grpNext").hide();

        function lblMessageString(data)
        {
            return data.answer_value + " (" + data.selected_note + "|" + data.selected_note_fullname + ") " +
                   (!data.answer ?  " ΣΩΣΤΗ (" + data.note_name + "|" + data.note_fullname + ")" : "" ) + ", " + data.score_str +
                   " => Βαθμολογία :: " + data.total_score_str + ", " + data.total_notes_str;
        }

        function lblStatusString(data)
        {
            return "Βαθμολογία :: " + data.total_score_str + ", " + data.total_notes_str;
        }

        $("#btnStart").click(function(){
            $.ajax({
                url: "commands/lessons/new-lesson.php",
                type: 'post',
                success: function(response){
                    $("#btnNext").click();
                },
                error: function(){
                    $('#myModal').modal({
                        keyboard: true
                    });
                },
                complete: function() {
                }
            })
        });

        $("#btnReturn").click(function(){
            window.location.href = "index.php";
        });

        $("#btnNoteEnd").click(function(){
            window.location.href = "summary.php";
        });

        $("#btnNextEnd").click(function(){
            window.location.href = "summary.php";
        });

        $("#btnNext").click(function(){
            $("#lblMessage").html( "<br><br>" );
            $.ajax({
                url: "commands/lessons/get-note.php",
                type: 'post',
                success: function(response){
                    var data = JSON.parse(response);
                    $('#imgNote').attr('src','commands/lessons/image.php?note_id=' + data.note_id);

                    $("#lblMessage").attr("class", "alert alert-warning");
                    $("#lblMessage").html( lblStatusString (data) );
                },
                error: function(){
                    $('#myModal').modal({
                        keyboard: true
                    });
                },
                complete: function() {
                    $("#grpStart").hide();
                    $("#grpNext").hide();
                    $("#grpNotes").show();
                }
            })
        });

        $("button").click(function(){
            if ( $(this).attr("data-value") == "btnNote" ){
                $.ajax({
                    url: "commands/lessons/check-note.php",
                    type: 'post',
                    data: {note: $(this).val() },
                    success: function(response){
                        var data = JSON.parse(response);

                        $("#lblMessage").attr("class", (data.answer ? "alert alert-success" : "alert alert-danger"));
                        $("#lblMessage").html( lblMessageString (data) );
                    },
                    error: function(){
                        $('#myModal').modal({
                            keyboard: true
                        });
                    },
                    complete: function() {
                        $("#grpNotes").hide();
                        $("#grpNext").show();
                    }
                })
            }
        });

        $("#btnNext").click(function(){
            $("#grpNext").hide();
            $("#grpNotes").show();
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
<?php
$sql = "SELECT
            settings_notes_name
        FROM users
        WHERE user_id = ".$db->quote( $User["user_id"]);
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$settings = $rows[ 0 ];
?>

<div role="main" class="col-md-2"></div>

<div role="main" class="col-md-8">

<!--    <div class="bs-docs-section">-->

        <div class="row">
            <h2 class="page-header">Ασκήσεις</h2>
<!--            <p class="lead" id="lblTitle">Εκπαιδευτικές ασκήσεις πάνω στις μουσικές νότες.</p>-->
        </div>

        <div class="row thumbnail">
            <img id="imgNote" src="images/image.png" >
        </div>

        <div class="row" id="grpMessage">
            <div class="alert alert-warning" id="lblMessage" style="text-align: center">Εκπαιδευτικές ασκήσεις πάνω στις μουσικές νότες</div>
        </div>

        <div class="row" id="grpNotes">
            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button type="button" value="C" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΝΤΟ" : "C"; ?></button>
                </div>
                <div class="btn-group">
                    <button type="button" value="D" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΡΕ" : "D"; ?></button>
                </div>
                <div class="btn-group">
                    <button type="button" value="E" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΜΙ" : "E"; ?></button>
                </div>
                <div class="btn-group">
                    <button type="button" value="F" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΦΑ" : "F"; ?></button>
                </div>
                <div class="btn-group">
                    <button type="button" value="G" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΣΟΛ" : "G"; ?></button>
                </div>
                <div class="btn-group">
                    <button type="button" value="A" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΛΑ" : "A"; ?></button>
                </div>
                <div class="btn-group">
                    <button type="button" value="B" data-value="btnNote" class="btn btn-default btn-lg btn-block"><?php echo $settings["settings_notes_name"] ? "ΣΙ" : "B"; ?></button>
                </div>
            </div><br>
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnNoteEnd" class="btn btn-default btn-lg btn-block">Τέλος</button>
                </div>
            </div>
        </div>

        <div class="row" id="grpNext">
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnNext" class="btn btn-primary btn-lg btn-block">Επόμενη</button>
                </div>
            </div><br>
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnNextEnd" class="btn btn-default btn-lg btn-block">Τέλος</button>
                </div>
            </div>
        </div>

        <div class="row" id="grpStart">
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnStart" class="btn btn-primary btn-lg btn-block">Έναρξη</button>
                </div>
            </div><br>
            <div class="btn-group-justified">
                <div class="btn-group">
                    <button type="button" id="btnReturn" class="btn btn-default btn-lg btn-block">Επιστροφή</button>
                </div>
            </div>
        </div>

<!--    </div>-->

</div>

<div role="main" class="col-md-2"></div>


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to save changes you made to document before closing?</p>
                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                <p class="text-info"><small><strong>Note:</strong> Press Tab key on the keyboard to enter inside the modal window after that press the Esc key.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</body>
</html>
