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
        $error = implode("<br>", $errorMessages);
    } else {
        include 'includes/config.php';
        // Escape user inputs to prevent SQL injection
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
        $userRole = 2;
        // Insert data into the database
        $sql = "INSERT INTO users (name, email, username, password, role) VALUES ('$name', '$email', '$username', '$password', '$userRole')";

        if ($con->query($sql) === TRUE) {
            $success = "Your account created successfully";
            // Use SweetAlert for success message
            echo "<script>displaySuccess('$success');</script>";
        } else {
            $error = "Error: " . $sql . "<br>" . $con->error;
            // Use SweetAlert for error message
            echo "<script>displayError('$error');</script>";
        }

        $con->close();
    }
}

?>