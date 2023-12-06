<?php
include('../../includes/sessions.php'); // Include the file containing session-related code

if (mysqli_connect_error()) {
    echo "Sorry Not Connected"; // Output an error message if there's a database connection error
}

if (isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the current password matches the one stored in the database
    if (password_verify($currentPassword, $login_password)) {
        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Passwords match, proceed to update the password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE users SET password='$hashedNewPassword' WHERE user_id='$login_id'";
            $result = mysqli_query($con, $sql);

            if ($result) {
                echo "
                <script>
                    alert('Your Password Successfully Changed');
                    window.location.href = 'users-profile.php'; // Redirect to the user's profile page
                </script>";
            } else {
                echo "Error updating password: " . mysqli_error($con); // Output an error message if the password update fails
            }
        } else {
            echo "
            <script>
                alert('New Password and Confirm Password do not match');
                window.location.href = 'users-profile.php'; // Redirect to the user's profile page
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Current Password is incorrect');
            window.location.href = 'users-profile.php'; // Redirect to the user's profile page
        </script>";
    }
} else {
    echo "Change password form not submitted."; // Output a message if the change password form is not submitted
}
?>
