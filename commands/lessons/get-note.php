<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

$lesson_note_id = $_SESSION["Lessons"]["Notes"]["lesson_id"];

//======================================================================================================================
// Get User Settings
//======================================================================================================================
$sql = "SELECT
          settings_notes_name,
          settings_notes_under,
          settings_notes_on,
          settings_notes_over
        FROM users
        WHERE user_id = ".$db->quote( $User["user_id"]);
///echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$settings = $rows[0];

//======================================================================================================================
// Get Note
//======================================================================================================================
$where = "";
if ($settings["settings_notes_under"]) $where .= ( $where ? ", " : "" ) . "1";
if ($settings["settings_notes_on"]) $where .= ( $where ? ", " : "" ) . "2";
if ($settings["settings_notes_over"]) $where .= ( $where ? ", " : "" ) . "3";

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
          positions.name as position
        FROM notes
        LEFT JOIN note_types on notes.note_type_id = note_types.note_type_id
        LEFT JOIN note_steps on notes.note_step_id = note_steps.note_step_id
        LEFT JOIN positions on notes.position_id = positions.position_id
        ".( $where ? "WHERE notes.position_id in (".$where.")" : "" )."
        ORDER BY RAND() LIMIT 1";
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//$random_note_array_id = rand( 0, $stmt->rowCount()-1 );
//$correct_note = $rows[ $random_note_array_id ];
$correct_note = $rows[ 0 ];


$sql = "INSERT INTO lesson_notes SET
        lesson_id = ".$db->quote( $lesson_note_id ).",
        note_id = ".$db->quote( $correct_note["note_id"] ).",
        note_type_id = ".$db->quote( $correct_note["note_type_id"] ).",
        start_at = CURRENT_TIMESTAMP,
        secs_to_solve = ".$db->quote( 10 )."
        ";
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$lesson_note_id = $db->lastInsertId();

$_SESSION["Lessons"]["Notes"]["lesson_note_id"] = $lesson_note_id;


$sql = "SELECT
          lesson_notes.lesson_note_id,
          lesson_notes.lesson_id,
          lesson_notes.note_type_id,
          lesson_notes.answer_note_type_id,
          lesson_notes.start_at,
          lesson_notes.secs_to_solve,
          lesson_notes.secs_to_find,
          lesson_notes.score,
          lessons.total_score,
          lessons.total_notes,
          lessons.correct_notes
        FROM lesson_notes
        LEFT JOIN lessons ON lesson_notes.lesson_id = lessons.lesson_id
        WHERE lesson_note_id = ".$db->quote( $lesson_note_id );
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$lesson_note = $rows[ 0 ];

$total_notes = $lesson_note[ "total_notes" ] + 1;
$correct_notes = $lesson_note[ "correct_notes" ];

$score = ($answer ? $secs_to_find : 0 );
$total_score = $lesson_note[ "total_score" ] + $score;



$data = array(
    "lesson_note_id" => $lesson_note_id,
    "note_id" => $correct_note["note_id"],
    "secs_to_solve" => 10,

    "total_score" => $total_score,
    "total_score_str" => "<b>" . $total_score . "</b> " . ($total_score == 1 ? "Βαθμός" : "Βαθμοί"),

    "score" => $score,
    "score_str" => "<b>" . $score . "</b> " . ($score == 1 ? "Βαθμός" : "Βαθμοί"),

    "total_notes" => $total_notes,
    "total_notes_str" => "<b>" . $total_notes . "</b> " . ($total_notes == 1 ? "Νότα" : "Νότες"),

    "correct_notes" => $correct_notes
);

echo json_encode( $data );
?>