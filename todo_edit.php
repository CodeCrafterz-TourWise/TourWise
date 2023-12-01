<?php
if (isset($_POST['update'])) {
    $taskId = $_POST['task_id']; // Get the task ID from the hidden input

    $editedTask = $_POST['edited_task'];

    include 'includes/config.php';

    // Use WHERE clause to update the specific task
    $sql = "UPDATE todos SET task='$editedTask' WHERE id='$taskId'";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Successfully Updated..')</script>";
        header('Location: todo.php'); // Redirect back to the todo.php page
        exit();
    } else {
        echo "<script>alert('Error updating task: " . mysqli_error($con) . "')</script>";
    }

    mysqli_close($con);
}
?>
