<?php
chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

//======================================================================================================================
// Get User Settings
//======================================================================================================================
//$sql = "SELECT
//          setting_notes_under,
//          settings_notes_in,
//          settings_notes_over
//        FROM users
//        WHERE user_id = ".$db->quote( $User["user_id"]);
////echo "<br><br>".$sql."<br><br>";
//
//$stmt = $db->query( $sql );
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//$settings = $rows[0];

//======================================================================================================================
// Get Notes
//======================================================================================================================

$note_id = $_GET["note_id"];

$sql = "SELECT
          note_id,
          letter,
          scale,
          note_types.name,
          fullname,
          position,
          notes.note_step_id
        FROM notes
        LEFT JOIN note_types on notes.note_type_id = note_types.note_type_id
        LEFT JOIN note_steps on notes.note_step_id = note_steps.note_step_id
        WHERE notes.note_id = ".$db->quote( $note_id )."
        ORDER BY RAND()";
//AND scale in (0 ".($settings["setting_notes_under"] ? ",1" : "").($settings["settings_notes_in"] ? ",2" : "").($settings["settings_notes_over"] ? ",3" : "").")";
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//======================================================================================================================
// Create rundom note
//======================================================================================================================

$random_note_array_id = mt_rand( 0, $stmt->rowCount()-1 );
$note = $rows[ $random_note_array_id ];
//$note = $rows[0];

$im = imagecreate(390, 180);

$bg = imagecolorallocate($im, 255, 255, 255);

$textcolor = imagecolorallocate($im, 0, 0, 0);

$staff_notes = array('==', '==', '==', '==', '==', '==', $note["letter"]);
shuffle( $staff_notes );

imagettftext($im, 60, 0, 20 , 120, $textcolor, 'commands/lessons/MusiQwik.ttf', '=&=');

$x = 58;

foreach($staff_notes as $key => $staff_note)
{
    $x += 38;
    if ( $staff_note <> "==")
        imagettftext($im, 60, 0, $x, (($note["position"]?:0) * 16) + 120, $textcolor, 'commands/lessons/MusiQwik.ttf', $staff_note);
    else
        imagettftext($im, 60, 0, $x, + 120, $textcolor, 'commands/lessons/MusiQwik.ttf', $staff_note);

    if ($note["note_step_id"] <> 1)
        imagettftext($im, 60, 0, $x + 19, + 120, $textcolor, 'commands/lessons/MusiQwik.ttf', "=");


    imagettftext($im, 20, 0, 180, 30, $textcolor, 'commands/lessons/arial.ttf', $note["note_id"]);
}

header('Content-type: image/png');

//$filename = $note["name"]."."."png";
//imagepng($im, $filename);

imagepng($im);
imagedestroy($im);

?>