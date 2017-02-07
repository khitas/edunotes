<?php
chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

//======================================================================================================================
// Get User Settings
//======================================================================================================================
$sql = "SELECT
          settings_notes_name,
          settings_notes_under,
          settings_notes_on,
          settings_notes_over,
          settings_debug
        FROM users
        WHERE user_id = ".$db->quote( $User["user_id"]);
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$settings = $rows[0];

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
          top_align,
          notes.note_step_id,
          notes.note_type_id,
          positions.position_id,
          positions.name as position,
          fonts.font_id,
          fonts.name as font
        FROM notes
        LEFT JOIN note_types on notes.note_type_id = note_types.note_type_id
        LEFT JOIN note_steps on notes.note_step_id = note_steps.note_step_id
        LEFT JOIN positions on notes.position_id = positions.position_id
        LEFT JOIN fonts on notes.font_id = fonts.font_id
        WHERE notes.note_id = ".$db->quote( $note_id );
        //AND scale in (0 ".($settings["setting_notes_under"] ? ",1" : "").
        //($settings["settings_notes_in"] ? ",2" : "").($settings["settings_notes_over"] ? ",3" : "").")";
//echo "<br><br>".$sql."<br><br>";


$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//======================================================================================================================
// Create rundom note
//======================================================================================================================

//$random_note_array_id = mt_rand( 0, $stmt->rowCount()-1 );
//$note = $rows[ $random_note_array_id ];
//$note = $rows[0];

//var_dump($rows);
//shuffle( $rows );

//var_dump($rows);
//$note = reset($rows);

$note = $rows[0];
//var_dump($note);

//die();
$im = imagecreate(390, 180);

$bg = imagecolorallocate($im, 255, 255, 255);

$textcolor = imagecolorallocate($im, 0, 0, 0);

$staff_notes = array('==', '==', '==', $note["letter"]);
shuffle( $staff_notes );

array_unshift($staff_notes, "==");
array_push($staff_notes, "==", "==");

//var_dump($staff_notes);
imagettftext($im, 60, 0, 20 , 120, $textcolor, 'fonts/'.$note["font"], '=&=');

$x = 58;

foreach($staff_notes as $key => $staff_note)
{
    $x += 38;
    if ( $staff_note <> "==")
        imagettftext($im, 60, 0, $x, (($note["top_align"]?:0) * 16) + 120, $textcolor, 'fonts/'.$note["font"], $staff_note);
    else
        imagettftext($im, 60, 0, $x, + 120, $textcolor, 'fonts/'.$note["font"], $staff_note);

    if ($note["note_step_id"] <> 1)
        imagettftext($im, 60, 0, $x + 19, + 120, $textcolor, 'fonts/'.$note["font"], "=");


    if ($settings["settings_debug"])
        imagettftext($im, 10, 0, 20, 20, $textcolor, 'fonts/courier.ttf', $note["note_id"]." - ".$note["name"]." - ".$note["fullname"]);
}

//header('Content-type: image/png');

//$filename = $note["name"]."."."png";
//imagepng($im, $filename);

imagepng($im);
imagedestroy($im);
?>