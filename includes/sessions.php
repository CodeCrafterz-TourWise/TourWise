<?php
// Establishing Connection with Server by passing server_name, user_id, and password as parameters
include 'config.php';
session_start(); // Starting Session

// Storing Session
$user_check = $_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_id = $row['user_id'];
$login_session = $row['name'];
$login_email = $row['email'];
$login_username = $row['username'];
$login_password = $row['password'];
$login_role = $row['role'];

//check the login session, if not logged in redirect to login page
if (!isset($login_session)) {
    mysqli_close($con); // Closing Connection
    header("Location: ../../login_page.php");
    exit();
}
?>
