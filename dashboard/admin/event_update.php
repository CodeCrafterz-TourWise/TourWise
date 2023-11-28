<?php
include('../../includes/sessions.php');  // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventTitle = mysqli_real_escape_string($con, $_POST["eventTitle"]);
    $eventDescription = mysqli_real_escape_string($con, $_POST["eventDescription"]);
    $adminId = mysqli_real_escape_string($con, $_POST["adminId"]);

    // Insert event update into the database
    $insertQuery = "INSERT INTO events (title, description, admin_id) VALUES ('$eventTitle', '$eventDescription', $adminId)";

    if (mysqli_query($con, $insertQuery)) {
        // Event update saved successfully
        header("Location: index.php");  // Redirect back to the admin panel
        exit();
    } else {
        // Error saving event update
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($con);
    }
}
?>
