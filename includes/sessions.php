<?php
// Establishing Connection with Server by passing server_name, user_id, and password as parameters
include 'config.php'; // Include the database configuration file
session_start(); // Starting Session

// Storing Session
$user_check = $_SESSION['login_user']; // Retrieve the logged-in user's username from the session

// SQL Query To Fetch Complete Information Of User
$ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);

// Extracting user information from the fetched row
$login_id = $row['user_id']; // User ID
$login_session = $row['name']; // User's Name
$login_email = $row['email']; // User's Email
$login_username = $row['username']; // User's Username
$login_password = $row['password']; // User's Password 
$login_role = $row['role']; // User's Role

// Check the login session, if not logged in, redirect to the login page
if (!isset($login_session)) {
    mysqli_close($con); // Closing Connection
    header("Location: ../../login_page.php"); // Redirect to the login page
    exit();
}
?>
