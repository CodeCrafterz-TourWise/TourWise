<?php
include('sessions.php');

if (mysqli_connect_error()) {
    echo "Sorry Not Connected";
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Update Information in the database with a WHERE clause
    $sql = "UPDATE users SET name='$name', email='$email', username='$username' WHERE u_id='$login_id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "
        <script>
            alert('Your Profile Successfully Updated');
            if ($login_role===1){ 
            window.location.href = '../dashboard/admin/users-profile.php';
            }
            else{
                window.location.href = '../dashboard/user/users-profile.php';
            }
        </script>";
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }
} else {
    echo "Update form not submitted.";
}
