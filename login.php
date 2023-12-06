<?php
session_start(); // Starting Session

$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    // Check if the username and password are provided
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        include 'includes/config.php'; // Include the database configuration file

        // Sanitize and validate user input
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $enteredPassword = $_POST['password'];

        // Selecting Database using a prepared statement
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($con, $sql); // Prepare the SQL statement
        mysqli_stmt_bind_param($stmt, "s", $username); // Bind the parameter to the statement
        mysqli_stmt_execute($stmt); // Execute the statement
        $result = mysqli_stmt_get_result($stmt); // Get the result set from the statement

        if (!$result) {
            die('Error: ' . mysqli_error($con)); // Handle any SQL errors
        }

        $rows = mysqli_num_rows($result); // Get the number of rows in the result set

        if ($rows == 1) {
            $row = mysqli_fetch_assoc($result); // Fetch the associative array representing the fetched row
            $storedPassword = $row['password']; // Get the hashed password from the database
            $userRole = $row['role']; // Get the user role from the database

            // Verify entered password with stored hashed password
            if (password_verify($enteredPassword, $storedPassword)) {
                // Set session and redirect based on user role
                $_SESSION['login_user'] = $username; // Initializing Session
                if ($userRole == 1) {
                    header("location: dashboard/admin/index.php"); // Redirect to the admin dashboard
                    exit();
                } elseif ($userRole == 2) {
                    header("location: index.php"); // Redirect to a regular user page
                    exit();
                } else {
                    $error = "Invalid role"; // Handle an invalid user role
                }
            } else {
                $error = "Username or Password is invalid"; // Handle incorrect password
            }
        } else {
            $error = "Username or Password is invalid"; // Handle non-existent user
        }

        // Closing Connection
        mysqli_stmt_close($stmt); // Close the prepared statement
        mysqli_close($con); // Close the database connection
    }
}
?>
