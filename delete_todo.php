<?php
include 'includes/sessions.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the 'task_id' parameter is set and is a positive integer
    if (isset($_POST['task_id']) && is_numeric($_POST['task_id']) && $_POST['task_id'] > 0) {
        // Sanitize and get the task ID from the POST data
        $taskId = mysqli_real_escape_string($con, $_POST['task_id']);

        // Prepare and execute the DELETE query
        $deleteQuery = "DELETE FROM todos WHERE id = $taskId";

        if (mysqli_query($con, $deleteQuery)) {
            // Return a success message
            echo json_encode(['status' => 'success']);
        } else {
            // Return an error message
            echo json_encode(['status' => 'error', 'message' => mysqli_error($con)]);
        }
    } else {
        // Return an error message if 'task_id' is not set or is invalid
        echo json_encode(['status' => 'error', 'message' => 'Invalid task ID']);
    }
} else {
    // Return an error message for non-POST requests
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
