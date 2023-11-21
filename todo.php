<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      a{
        text-decoration: none;
      }
      
    </style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Tour Wise</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav nav-pills nav-fill me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="plan.php">Plan your visit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="todo.php">Todo</a>
              </li>
          </ul>
          <?php
          require_once('includes/config.php');
          session_start(); // Starting Session
         
          // Check if the user is logged in
          if (isset($_SESSION['login_user'])) {
             
            // Storing Session
            $user_check = $_SESSION['login_user'];
            
            // SQL Query To Fetch Complete Information Of User
            $ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
            $row = mysqli_fetch_assoc($ses_sql);
            $login_session = $row['name'];
  
            // If logged in, display the "User" button with the user's name
            echo '<div>';
            echo '<a href="dashboard/user/users-profile.php"><button class="btn btn-outline-light" type="button" aria-expanded="false">';
            echo '<i class="fa fa-user" aria-hidden="true"></i> ' . $login_session;
            echo '</button></a>';
            echo '</div>';
          } else {
            // If not logged in, redirect to login page
            header("location: login_page.php");
          }
          ?>
        </div>
      </div>
    </nav>

    <footer class="bg-dark text-white py-4 fixed-bottom" style="margin-top: 30px;text-align: center;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  <h4>Contact Us</h4>
                  <p>
                      Phone: +94 752711909<br>
                      Email: tourwisemanage@gmail.com
                  </p>
              </div>
              <div class="col-md-6">
                  <h4>Quick Links</h4>
                  <ul style="list-style-type: none;padding-inline-start: 0;">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="plan.php">Plan your visit</a></li>
                      <li><a href="#">Todo</a></li>
                  </ul>
              </div>
          </div>
          <div>
            <p>&copy; 2023 Designed By <i>CODE CRAFTERZ</i></p>
          </div>
      </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
</body>
</html>