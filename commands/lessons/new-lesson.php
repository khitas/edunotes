<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

$sql = "INSERT INTO lessons SET
        user_id = ".$db->quote( $User["user_id"] ).",
        start_at = CURRENT_TIMESTAMP
        ";
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$lesson_id = $db->lastInsertId();

$_SESSION["Lessons"]["Notes"]["lesson_id"] = $lesson_id;
unset($_SESSION["Lessons"]["Notes"]["lesson_note_id"]);

$data = array(
    "lesson_id" => $lesson_id
);

echo json_encode( $data );

?>