<?php
include('includes/config.php');

session_start(); // Starting Session

// Check if the user is logged in
if (isset($_SESSION['login_user'])) {

  // Storing Session
  $user_check = $_SESSION['login_user'];

  // SQL Query To Fetch Complete Information Of User
  $ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
  $row = mysqli_fetch_assoc($ses_sql);
  $login_id = $row['user_id'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentText = mysqli_real_escape_string($con, $_POST["commentText"]);
    $userId = $login_id;  // Assuming you have a user_id in the session
    $provinceId = isset($_GET['id']) ? (int)$_GET['id'] : 0;  // Retrieve the province ID from the URL

    // Validate if $provinceId is a positive integer before using it in the query
    if ($provinceId <= 0) {
        echo "Invalid province ID";
        exit();
    }

    // Upload image
    $targetDir = "uploads/"; 
    $targetFile = $targetDir . basename($_FILES["commentImage"]["name"]);
    move_uploaded_file($_FILES["commentImage"]["tmp_name"], $targetFile);

    // Insert comment into the database
    $insertQuery = "INSERT INTO comments (c_text, c_image, u_id, pro_id) VALUES ('$commentText', '$targetFile', $userId, $provinceId)";

    if (mysqli_query($con, $insertQuery)) {
        // Comment saved successfully
        header("Location: province.php?id=$provinceId");  // Redirect back to the province page with the ID
        exit();
    } else {
        // Error saving comment
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($con);
    }
}

}
  else{
    mysqli_close($con); // Closing Connection
    header("Location: login_page.php");
    exit();
  }

?>
