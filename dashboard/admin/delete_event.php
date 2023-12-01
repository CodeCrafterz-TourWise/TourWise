<?php
include('../../includes/sessions.php');  // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventId = mysqli_real_escape_string($con, $_POST["eventId"]);

    // Check if the user is authorized to delete
    $checkQuery = "SELECT * FROM events WHERE event_id = $eventId AND admin_id = $login_id";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // User is authorized to delete
        $deleteQuery = "DELETE FROM events WHERE event_id = $eventId";

        if (mysqli_query($con, $deleteQuery)) {
            // Event update deleted successfully
            header("Location: index.php");  // Redirect back to the event page
            exit();
        } else {
            // Error deleting event update
            echo "Error: " . $deleteQuery . "<br>" . mysqli_error($con);
        }
    } else {
        // User is not authorized to delete
        echo "Unauthorized to delete this event update.";
    }
}
?>
