<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

$lesson_id = $_POST["lesson_id"];

$_SESSION["View"]["lesson_id"] = $lesson_id;

$data = array(
    "lesson_id" => $lesson_id
);

echo json_encode( $data );

?>