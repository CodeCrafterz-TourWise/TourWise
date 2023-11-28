<?php
include('includes/config.php');
session_start(); // Starting Session

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    // User is not logged in, redirect to the login page
    header("Location: login_page.php");
    exit();
}

  // Storing Session
  $user_check = $_SESSION['login_user'];

  // SQL Query To Fetch Complete Information Of User
  $ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
  $row = mysqli_fetch_assoc($ses_sql);
  $login_id = $row['user_id'];
// Check if comment_id and province_id are set in the URL
if (isset($_GET['comment_id']) && isset($_GET['province_id'])) {
    $commentId = (int)$_GET['comment_id'];
    $provinceId = (int)$_GET['province_id'];

    // Delete the comment only if the logged-in user is the owner of the comment
    $deleteQuery = "DELETE FROM comments WHERE comment_id = $commentId AND u_id = $login_id";
    if (mysqli_query($con, $deleteQuery)) {
        // Comment deleted successfully
        header("Location: province.php?id=$provinceId");
        exit();
    } else {
        // Error deleting comment
        echo "Error: " . $deleteQuery . "<br>" . mysqli_error($con);
    }
} else {
    // Invalid URL parameters, redirect to an error page or the home page
    header("Location: error.php");
    exit();
}
?>
