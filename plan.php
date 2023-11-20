<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlanYourVisit</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      a{
        text-decoration:none;
      }
      .card {
          position: relative;
      }
  
      .card-img-overlay {
          background-color: rgba(0, 0, 0, 0.5);
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          opacity: 0;
          transition: opacity 0.3s;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          text-align: center;
      }
  
      .card:hover .card-img-overlay {
          opacity: 1;
      }
      .card:hover .card-title {
          opacity: 0;
      }
      .overlay-text {
          color: #fff; /* Text color */
          font-size: 20px; /* Text size */
          font-weight: bold; /* Text weight */
      }
  </style>
  
  
  
</head>
<body style="background-color: rgb(242, 244, 243);">
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Tour Wise</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav nav-pills nav-fill me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="plan.html">Plan your visit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="todo.html">Todo</a>
              </li>
          </ul>
          <?php
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['login_user'])) {
          // If logged in, display the "User" button with the user's name
          echo '<div>';
          echo '<a href="dashboard/user/index.php"><button class="btn btn-outline-light" type="button" aria-expanded="false">';
          echo '<i class="fa fa-user" aria-hidden="true"></i> ' . $_SESSION['login_user'];
          echo '</button></a>';
          echo '</div>';
        } else {
          // If not logged in, display the "Sign In" button
          echo '<div class="d-grid gap-2 d-md-block text-center">';
          echo '<a href="login_page.php"><button class="btn btn-outline-light" type="button"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In </button></a>';
          echo '</div>';
        }
        ?>
        </div>
      </div>
    </nav>

  <div class="container mt-5 p-3" style="padding-top:20px">
    <h2>Choose a province for your preference</h2>
      <div class="row mb-3 mt-4">
          <div class="col-md-3 mb-3">
            <a href="provinces/western.html">
              <div class="card position-relative">
                  <img src="assets/Colombo Fort.jpg" class="card-img-top" alt="Western Province"style="width: 100%; height: 200px;">
                  <div class="card-img-overlay">
                    <div class="overlay-text">Select Western</div>
                  </div>
                  <div class="card-body">
                      <h5 class="card-title">Western Province</h5>
                  </div>
              </div>
            </a>
          </div>
  
          <div class="col-md-3 mb-3">
            <a href="provinces/eastern.html">
              <div class="card position-relative">
                  <img src="assets/Trincomalee beach.webp" class="card-img-top" alt="Eastern Province"style="width: 100%; height: 200px;">
                  <div class="card-img-overlay">
                    <div class="overlay-text">Select Eastern</div>
                  </div>
                  <div class="card-body">
                      <h5 class="card-title">Eastern Province</h5>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="provinces/southern.html">
              <div class="card position-relative">
                  <img src="assets/Galle Fort.jpg" class="card-img-top" alt="Southern Province"style="width: 100%; height: 200px;">
                  <div class="card-img-overlay">
                    <div class="overlay-text">Select Southern</div>
                  </div>
                  <div class="card-body">
                      <h5 class="card-title">Southern Province</h5>
                  </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="provinces/central.html">
            <div class="card position-relative">
                <img src="assets/Pinnawala Elephant orphanage.jpg" class="card-img-top" alt="Central Province"style="width: 100%; height: 200px;">
                <div class="card-img-overlay">
                  <div class="overlay-text">Select Central</div>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Central Province</h5>
                </div>
            </div>
            </a>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 mb-3">
            <a href="provinces/northern.html">
            <div class="card position-relative">
                <img src="assets/jaffna library.jpg" class="card-img-top" alt="Northern Province"style="width: 100%; height: 200px;">
                <div class="card-img-overlay">
                  <div class="overlay-text">Select Northern</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Northern Province</h5>
                </div>
            </div>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="provinces/uva.html">
            <div class="card position-relative">
                <img src="assets/Little Adam's peak.jpg" class="card-img-top" alt="Uva Province"style="width: 100%; height: 200px;">
                <div class="card-img-overlay">
                  <div class="overlay-text">Select Uva</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Uva Province</h5>
                </div>
            </div>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <a href="provinces/northcentral.html">
            <div class="card position-relative">
                <img src="assets/Mihintale.jpg" class="card-img-top" alt="North Central Province"style="width: 100%; height: 200px;">
                <div class="card-img-overlay">
                  <div class="overlay-text">Select North Central</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">North Central Province</h5>
                </div>
            </div>
            </a>
          </div>
        </div>
  </div>
  <footer class="bg-dark text-white py-4" style="margin-top: 30px;text-align: center;">
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Plan your visit</a></li>
                    <li><a href="todo.html">Todo</a></li>
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