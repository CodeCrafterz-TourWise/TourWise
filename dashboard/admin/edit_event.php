<?php
include('../../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $eventId = $_POST['eventId'];
    $editEventTitle = $_POST['editEventTitle'];
    $editEventDescription = $_POST['editEventDescription'];

    // Validate and sanitize the input as needed

    // Update the event in the database using prepared statements
    $updateQuery = "UPDATE events SET title = ?, description = ? WHERE event_id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($con, $updateQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $editEventTitle, $editEventDescription, $eventId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Successful update
        header("Location: index.php"); // Redirect to the dashboard or wherever you want to go after editing
        exit();
    } else {
        // Handle the error
        echo "Error updating event: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If the form wasn't submitted via POST, redirect or handle accordingly
    header("Location: index.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>