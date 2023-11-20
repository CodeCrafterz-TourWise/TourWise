<?php
session_start(); // Starting Session

$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    // Check if the username and password are provided
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        include 'includes/config.php';

        // Sanitize and validate user input
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $enteredPassword = $_POST['password'];

        // Selecting Database using a prepared statement
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];
            $userRole = $row['role'];

            // Verify entered password with stored hashed password
            if (password_verify($enteredPassword, $storedPassword)) {
                // Set session and redirect based on user role
                $_SESSION['login_user'] = $username; // Initializing Session
                if ($userRole == 1) {
                    header("location: dashboard/admin/index.php");
                    exit();
                } elseif ($userRole == 2) {
                    header("location: index.php");
                    exit();
                } else {
                    $error = "Invalid role";
                }
            } else {
                $error = "Username or Password is invalid";
            }
        } else {
            $error = "Username or Password is invalid";
        }

        // Closing Connection
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }
}
?>
