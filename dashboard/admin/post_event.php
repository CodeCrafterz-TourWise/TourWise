<?php
include('../../includes/sessions.php');  // Include database configuration file and session check

if (isset($_POST['post_event'])) { // Check if the form has been submitted using the POST method
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
else {
    echo "Event post form not submitted."; // Output a message if the event post form is not submitted
}
?>
