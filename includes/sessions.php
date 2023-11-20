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

if (!isset($login_session)) {
    mysqli_close($con); // Closing Connection
    header('Location: ../../login_page.php'); // Redirecting To Home Page
    exit(); // Make sure to exit after redirection to prevent further script execution
}

// Set time limit to 10 minutes (600 seconds) for session timeout
$inactive = 600; // 10 minutes
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy(); // Destroy the session and redirect to the login page
        header('Location: ../../login_page.php');
        exit();
    }
}
$_SESSION['timeout'] = time(); // Reset the session timeout on activity
?>
