<?php
include 'config.php';
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($con, "SELECT * FROM users WHERE username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);

if (!$row) {
    mysqli_close($con);
    header('Location: index.php');
    exit(); // It's a good practice to exit after sending a header redirect
}

$login_name = $row['name'];
$login_email = $row['email'];
$login_username = $row['username'];
$login_password = $row['password']; // Assuming the password is stored as plain text

?>
