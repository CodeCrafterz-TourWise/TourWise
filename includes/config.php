<?php
$hostname = 'localhost';
 // Specify the correct port number here
$username = 'root';
$password = '';
$database = 'undergraduate_db';

$con = mysqli_connect($hostname, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>