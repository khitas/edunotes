<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

$settings_notes_name = $_POST["settings_notes_name"];
$settings_notes_under = $_POST["settings_notes_under"];
$settings_notes_on = $_POST["settings_notes_on"];
$settings_notes_over = $_POST["settings_notes_over"];
$settings_debug = $_POST["settings_debug"];

$sql = "UPDATE users SET
          settings_notes_name = ".($settings_notes_name === 'true' ? 1 : 'null').",
          settings_notes_under = ".($settings_notes_under === 'true' ? 1 : 'null').",
          settings_notes_on = ".($settings_notes_on === 'true' ? 1 : 'null').",
          settings_notes_over = ".($settings_notes_over === 'true' ? 1 : 'null').",
          settings_debug = ".($settings_debug === 'true' ? 1 : 'null')."
        WHERE user_id = ".$db->quote( $User["user_id"]);
//echo "<br><br>".$sql."<br><br>";

$stmt = $db->query( $sql );
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row = $rows[ 0 ];

$data = array(
    "settings_notes_name" => $row["settings_notes_name"],
    "settings_notes_under" => $row["settings_notes_under"],
    "settings_notes_on" => $row["settings_notes_on"],
    "settings_notes_over" => $row["settings_notes_over"],
    "settings_debug" => $row["settings_debug"]
);

echo json_encode( $data );

?>