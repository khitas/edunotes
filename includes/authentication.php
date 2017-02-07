<?php
session_start();

if ( $_SESSION[ "User" ] )
{
    $User["user_id"] = $_SESSION["User"]["user_id"];
    $User["username"] = $_SESSION["User"]["username"];
}
else if ( isset( $_REQUEST[ "username" ] ) || isset( $_REQUEST[ "password" ] ) )
{
    $sql = "SELECT user_id, username
            FROM users
            WHERE username = ".$db->quote( $_REQUEST[ "username" ] )." and password = ".$db->quote( md5( $_REQUEST[ "password" ] ) );
    //echo "<br><br>".$sql."<br><br>";

    $stmt = $db->query( $sql );
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ( count($rows) > 0 )
    {
        $User["user_id"] = $rows[0]["user_id"];
        $_SESSION["User"]["user_id"] = $User["user_id"];

        $User["username"] = $rows[0]["username"];
        $_SESSION["User"]["username"] = $User["username"];
    }
    else
    {
        header( "location: logout.php" );
        exit;
    }
}
else
{
    header( "location: logout.php" );
    exit;
}
?>