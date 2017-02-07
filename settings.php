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

        $('#chNotesName').bootstrapSwitch('size', 'medium');
        $('#chNotesUnder').bootstrapSwitch('size', 'medium');
        $('#chNotesOn').bootstrapSwitch('size', 'medium');
        $('#chNotesOver').bootstrapSwitch('size', 'medium');
        $('#chDebug').bootstrapSwitch('size', 'medium');

        $('#chNotesName').on('switchChange', function (e, data) {
            $("#lblMessage").html( "Αλλαγή ρυθμίσεων" );
        });

        $('#chNotesUnder').on('switchChange', function (e, data) {
            $("#lblMessage").html( "Αλλαγή ρυθμίσεων" );
        });

        $('#chNotesOn').on('switchChange', function (e, data) {
            $("#lblMessage").html( "Αλλαγή ρυθμίσεων" );
        });

        $('#chNotesOver').on('switchChange', function (e, data) {
            $("#lblMessage").html( "Αλλαγή ρυθμίσεων" );
        });

        $('#chDebug').on('switchChange', function (e, data) {
            $("#lblMessage").html( "Αλλαγή ρυθμίσεων" );
        });

        $.ajax({
            url: "commands/settings/get-settings.php",
            type: 'post',
            success: function(response){
                var data = JSON.parse(response);
                $('#chNotesName').bootstrapSwitch('state', data.settings_notes_name);
                $('#chNotesUnder').bootstrapSwitch('state', data.settings_notes_under);
                $('#chNotesOn').bootstrapSwitch('state', data.settings_notes_on);
                $('#chNotesOver').bootstrapSwitch('state', data.settings_notes_over);
                $('#chDebug').bootstrapSwitch('state', data.settings_debug);
            },
            error: function(){
                $('#myModal').modal({
                    keyboard: true
                });
            },
            complete: function() {
            }
        })

        $("#btnSave").click(function(){
            $.ajax({
                url: "commands/settings/set-settings.php",
                type: 'post',
                data:{
                    settings_notes_name : $('#chNotesName').bootstrapSwitch('state'),
                    settings_notes_under : $('#chNotesUnder').bootstrapSwitch('state'),
                    settings_notes_on : $('#chNotesOn').bootstrapSwitch('state'),
                    settings_notes_over : $('#chNotesOver').bootstrapSwitch('state'),
                    settings_debug : $('#chDebug').bootstrapSwitch('state')
                },
                success: function(response){
                    $("#lblMessage").html( "Οι ρυθμίσεις αποθηκεύτηκαν" );
                },
                error: function(){
//                    $('#myModal').modal({
//                        keyboard: true
//                    });
                },
                complete: function() {
                }
            })
        });

        $("#btnReturn").click(function(){
            window.location.href = "index.php";
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
            <h2 class="page-header">Ρυθμίσεις</h2>
            <!--            <p class="lead" id="lblTitle">Επιλέξτε μία από τις παρακάτω κατηγορίες</p>-->
        </div>

        <div class="row" id="grpMessage">
            <div class="well well-sm" id="lblMessage" style="text-align: center">Ρυθμίσεις<br></div>
        </div>

        <div class="row">
            <div class="form-group">
                <input id="chNotesName" type="checkbox" checked>
                <label class="control-label" for="chNotesName">Εμφάνιση ονόματος της νότας στα κουμπιά </label>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <input id="chNotesUnder" type="checkbox" checked>
                <label class="control-label" for="chNotesUnder">Νότες κάτω από το πεντάγραμμο </label>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <input id="chNotesOn" type="checkbox" checked>
                <label class="control-label" for="chNotesOn">Νότες μεσα στο πεντάγραμμο </label>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <input id="chNotesOver" type="checkbox" checked>
                <label class="control-label" for="chNotesOver">Νότες πάνω από το πεντάγραμμο </label>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <input id="chDebug" type="checkbox" checked>
                <label class="control-label" for="chDebug">Debug </label>
            </div>
        </div>

        <div class="row">
            <div class="btn-group-justified">
                <div class="btn-group" id="grpSave">
                    <button type="button" id="btnSave" class="btn btn-primary btn-lg btn-block">Αποθήκευση</button>
                </div>
            </div></br>
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