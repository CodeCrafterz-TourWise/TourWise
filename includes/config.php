<?php
$hostname = 'localhost';
 // Specify the correct port number here if not remove it. 
$username = 'root';
$password = '';
$database = 'tourwise';

$con = mysqli_connect($hostname, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
