<?php
$host = "localhost";
$user = "jeanpaul";
$pass = "222011858";
$database = "carsurvey";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>