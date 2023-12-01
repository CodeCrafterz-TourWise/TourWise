<?php

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorMessages = array();

    if (empty($_POST['name'])) {
        $errorMessages[] = "Please enter your name.";
    }

    if (empty($_POST['email'])) {
        $errorMessages[] = "Please enter your email address.";
    }

    if (empty($_POST['username'])) {
        $errorMessages[] = "Please choose a username.";
    }

    if (empty($_POST['password'])) {
        $errorMessages[] = "Please enter your password.";
    }

    if (!empty($errorMessages)) {
        $error = implode(" ", $errorMessages);
    } else {
        include 'includes/config.php';

        // Escape user inputs to prevent SQL injection
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
        $userRole = 2;

        // Check if the username is already taken
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $checkUsernameQuery);

        if (mysqli_num_rows($result) > 0) {
            $error = "Username '$username' is already taken. Please choose a different username.";
            // Use SweetAlert for error message
            echo "<script>displayError('$error');</script>";
        } else {
            // Insert data into the database
            $insertQuery = "INSERT INTO users (name, email, username, password, role) VALUES ('$name', '$email', '$username', '$password', '$userRole')";

            if ($con->query($insertQuery) === TRUE) {
                $success = "Your account was created successfully";
                // Use SweetAlert for success message
                echo "<script>displaySuccess('$success');</script>";
            } else {
                $error = "Error: " . $insertQuery . "<br>" . $con->error;
                // Use SweetAlert for error message
                echo "<script>displayError('$error');</script>";
            }
        }

        $con->close();
    }
}

?>
