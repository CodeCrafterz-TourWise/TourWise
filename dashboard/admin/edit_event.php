<?php
include('../../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $eventId = $_POST['eventId'];
    $editEventTitle = $_POST['editEventTitle'];
    $editEventDescription = $_POST['editEventDescription'];

    // Sanitize the input (ensure to validate and sanitize thoroughly in a real-world scenario)
    $editEventTitle = mysqli_real_escape_string($con, $editEventTitle);
    $editEventDescription = mysqli_real_escape_string($con, $editEventDescription);

    // Update the event in the database
    $updateQuery = "UPDATE events SET title = '$editEventTitle', description = '$editEventDescription' WHERE event_id = $eventId";

    // Execute the query
    if (mysqli_query($con, $updateQuery)) {
        // Successful update
        header("Location: index.php"); // Redirect to the dashboard or wherever you want to go after editing
        exit();
    } else {
        // Handle the error
        echo "Error updating event: " . mysqli_error($con);
    }
} else {
    // If the form wasn't submitted via POST, redirect or handle accordingly
    header("Location: index.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>
