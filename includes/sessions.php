<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include 'config.php';
session_start(); // Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = mysqli_query($con, "select name from users where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['name'];
if (!isset($login_session)) {
    mysqli_close($con); // Closing Connection
    header('Location: index.php'); // Redirecting To Home Page
}