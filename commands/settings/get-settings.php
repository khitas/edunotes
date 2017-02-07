<?php

chdir("../../");

include "includes/settings.php";
include "includes/authentication.php";

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