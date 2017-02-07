<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

$lesson_id = $_POST["lesson_id"];

$sql = "DELETE FROM lessons
        WHERE user_id = ".$db->quote( $User["user_id"] )." AND lesson_id = ".$db->quote($lesson_id);
//echo "<br><br>".$sql."<br><br>";

$db->query( $sql );

$data = array(
    "lesson_id" => $lesson_id
);

echo json_encode( $data );

?>