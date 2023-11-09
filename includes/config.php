<?php
$hostname = 'localhost';
$port = 3310; // Specify the correct port number here
$username = 'root';
$password = '';
$database = 'undergraduate_db';

$con = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
