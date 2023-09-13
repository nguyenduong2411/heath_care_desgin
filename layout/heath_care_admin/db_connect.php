<?php

$hostname     = "satao.db.elephantsql.com";
$username     = "dhxqpdrw";
$password     = "dU9khect5Jv0jDEv15Zb6oPrhK6Fwywx";
$databasename = "dhxqpdrw";
// Create connection
$conn = new PDO("pgsql:host=$hostname;dbname=$databasename", $username, $password);

// Check connection
if (!$conn) {
    die("Không thể kết nối đến database:" . pg_connect_error());
}

?>