<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "weather_data";

// creating connection
$con = mysqli_connect($hostname, $username, $password, $dbname);

// check connection
if (!$con) {
    die("Connection error: " . mysqli_connect_error());
}
?>
