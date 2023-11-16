<?php
session_start();
if (session_destroy()) {
    // Session has been destroyed successfully
    header("Location: login_page.php");
    exit(); // It's a good practice to exit after a header redirect
} else {
    // Handle the case where session destruction fails
    echo "Logout failed. Please try again.";
}
?>
