<?php
include("includes/sessions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   // Assuming $con is your database connection
    $stmt = $con->prepare("INSERT INTO todos (task, user_id) VALUES (?, ?)");
    $stmt->bind_param("si", $task, $login_id);

    $task = $_POST["task"];

    if ($stmt->execute()) {
        header("Location: todo.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

}
?>
