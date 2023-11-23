<?php
include("includes/sessions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST["task"];

    // Insert the task into the database
    $sql = "INSERT INTO todos (task) VALUES ('$task')";

    if ($con->query($sql) === TRUE) {
        header("Location: todo.php");
        exit(); // Make sure to exit after a header redirect
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>
