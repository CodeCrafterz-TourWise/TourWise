<?php
session_start(); // Starting Session

$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        include 'includes/config.php';

        // Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Selecting Database
        $sql = "SELECT * FROM users WHERE password='$password' AND username='$username'";
        
        // SQL query to fetch information of registered users and find user match.
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $userRole = $row['role'];

            if ($userRole == 1) {
                // Admin dashboard
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: dashboard/admin/index.php");
            } elseif ($userRole == 2) {
                // User dashboard
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: dashboard/user/index.php");
            } else {
                $error = "Invalid role";
            }
        } else {
            $error = "Username or Password is invalid";
        }
        
        mysqli_close($con); // Closing Connection
    }
}
?>
