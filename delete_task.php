<?php
include 'includes/sessions.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the 'task_id' parameter is set
    if (isset($_POST['task_id'])) {
        // Sanitize and get the task ID from the POST data
        $taskId = mysqli_real_escape_string($con, $_POST['task_id']);

        // Prepare and execute the DELETE query
        $deleteQuery = "DELETE FROM todos WHERE id = $taskId";

        if (mysqli_query($con, $deleteQuery)) {
            // Return a success message
            echo 'success';
        } else {
            // Return an error message
            echo 'error';
        }
    } else {
        // Return an error message if 'task_id' is not set
        echo 'error';
    }
} else {
    // Return an error message for non-POST requests
    echo 'error';
}
?>
