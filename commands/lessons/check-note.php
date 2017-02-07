<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

$data = array();

//======================================================================================================================
//= Get Current Lesson Note Info
//======================================================================================================================

$lesson_note_id = $_SESSION["Lessons"]["Notes"]["lesson_note_id"];

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

//======================================================================================================================
//= Get Selected Note
//======================================================================================================================

$note = $_POST["note"];

$sql = "SELECT
          note_type_id,
          name,
          fullname
        FROM note_types
        WHERE name like ".$db->quote($note);
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selected_note = $rows[ 0 ];


//======================================================================================================================
//= Get Correct Note
//======================================================================================================================

$sql = "SELECT
              note_type_id,
              name,
              fullname
            FROM note_types
            WHERE note_type_id = ".$db->quote( $lesson_note["note_type_id"] );
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$correct_note = $rows[ 0 ];

//======================================================================================================================
// Check data
//======================================================================================================================

$secs_to_find = 1;

$answer = ($lesson_note["note_type_id"] == $selected_note["note_type_id"]);

$total_notes = $lesson_note[ "total_notes" ] + 1;
$correct_notes = $lesson_note[ "correct_notes" ] + ($answer ? 1 : 0);

$score = ($answer ? $secs_to_find : 0 );
//$score = ($answer ? 10 - $secs_to_find : 0 );
$total_score = $lesson_note[ "total_score" ] + $score;

//======================================================================================================================
// Update Lesson Note
//======================================================================================================================

$sql = "UPDATE lesson_notes SET
                answer_note_type_id = ".$db->quote( $selected_note["note_type_id"] ).",
                secs_to_find  = ".$db->quote( $secs_to_find ).",
                score = ".$db->quote( $score )."
            WHERE lesson_note_id = ".$db->quote( $lesson_note_id );
//echo "<br><br>".$sql."<br><br>";
$db->query( $sql );

//======================================================================================================================
// Update Lesson
//======================================================================================================================

$sql = "UPDATE lessons SET
                total_notes = ".$db->quote( $total_notes ).",
                correct_notes  = ".$db->quote( $correct_notes ).",
                total_score = ".$db->quote( $total_score )."
            WHERE lesson_id = ".$db->quote( $lesson_note[ "lesson_id" ] );
//echo "<br><br>".$sql."<br><br>";
$db->query( $sql );

//======================================================================================================================
// Returned data
//======================================================================================================================

$data = array(
    "answer" => $answer,
    "answer_value" => ($answer ? "ΣΩΣΤΟ" : "ΛΑΘΟΣ"),

    "note_name" => $correct_note["name"],
    "note_fullname" => $correct_note["fullname"],

    "selected_note" => $selected_note["name"],
    "selected_note_fullname" => $selected_note["fullname"],

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