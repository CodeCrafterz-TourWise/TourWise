<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tourwise</title>
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    a{
      text-decoration:none;
    }
    .hero-image {
      background-image: url('assets/coverbg.jpg');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      margin-top: 50px;
      height: 600px;
      width: 100%;
      position: relative;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.7;
      background-color: black;
    }

    .hero-text {
      position: absolute;
      /* Position text over the image */
      top: 50%;
      /* Center text vertically */
      left: 50%;
      /* Center text horizontally */
      transform: translate(-50%, -50%);
      /* Compensate for absolute positioning */
      color: #ffffff;
      text-align: center;
    }

    .card-corner-gif {
      position: absolute;
      top: 0;
      right: 0;
      width: 50px;
      /* Adjust the width as needed */
      height: 50px;
      /* Adjust the height as needed */
    }
  </style>
</head>

<body style="background-color: #fff;">
  <nav id="navbar" class="navbar fixed-top navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">Tour Wise</span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-pills nav-fill me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="plan.php">Plan your visit</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="todo.php">My Journey</a>
          </li>
        </ul>
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
          $login_session = $row['name'];
          $user_role = $row['role'];

          // If user role is 1 (admin), set the dashboard link accordingly
          $dashboardLink = ($user_role == 1) ? 'dashboard/admin/index.php' : 'dashboard/user/users-profile.php';

          // Display the "User" button with the appropriate href
          echo '<div class="d-grid gap-2 d-md-block text-center">';
          echo '<a href="' . $dashboardLink . '"><button class="btn btn-outline-light" type="button" aria-expanded="false">';
          echo '<i class="fa fa-user" aria-hidden="true"></i> ' . $login_session;
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
  <div class="hero-image">
    <div class="hero-overlay"></div>
    <div class="hero-text">
      <h1>Welcome to Tourwise!</h1>
      <p>Plan your perfect vacation with our easy-to-use tools.</p>
      <a href="javascript:void(0);" onclick="scrollToSection('intro')" class="btn btn-primary">Get Started</a>
    </div>
  </div>
  <section id="intro" class="container mt-5">
    <div class="row">
      <div class="col-lg-8" style="background-color: rgb(242, 244, 243);padding: 1em;border-radius: 10px;">
        <h2 style="color:#434f5b">About Sri Lankan Tourism</h2>
        
        <p><img src="assets/lotustower.jpg" style="width:340px;height:500px;margin-left:15px;float: right;">
          "Explore the beauty of Sri Lanka, often called the 'Pearl of the Indian Ocean.' This tropical paradise is known for its stunning beaches, lush landscapes, rich history, and warm culture. Whether you love the beach, seek adventure, or adore history, Sri Lanka has it all.
        <br><br>
          The country's endless beaches are perfect for sun and sea lovers. Its lush hills and forests are a paradise for adventurers, offering hikes and wildlife encounters. Explore ancient ruins that tell captivating stories about its past.
        <br><br>
        
          The friendly locals make you feel welcome, and you can't miss the chance to see the elephants, a symbol of the country. Surfers will find exciting waves along the coast, and the affordable train system offers scenic rides.
        <br><br>
          Don't forget to enjoy Sri Lanka's famous tea and try its delicious cuisine, a blend of flavorful spices. Sri Lanka's unique charm and diverse attractions make it a great destination for all types of travelers."
        </p>
      </div>
      <div class="col-lg-4">
      <div style="color:#fff;background-color: #2b3035;padding: 1em;border-radius: 10px;">
      <h2 style="color:#0d6efd">Event Updates</h2>
        <?php
        // Fetch event updates from the database and display them here
        $eventQuery = "SELECT * FROM events ORDER BY event_id DESC LIMIT 4";
        $eventResult = mysqli_query($con, $eventQuery);

        while ($event = mysqli_fetch_assoc($eventResult)) {
          echo '<div>';
          echo '<h6 style="display: flex; align-items: center;">' . $event['title'] . '<img src="assets/new.gif" alt="GIF" width="20px" height="20px" style="margin-left: 5px;"></h6>';
          echo '<p>' . $event['description'] . '</p>';
          echo '<hr>';
          echo '</div>';
        }
        ?>
        </div>
      </div>
    </div>
  </section>
  <section class="container mt-5" style="background-color: rgb(242, 244, 243);padding: 1em;border-radius: 10px;">
    <h2 style="color:#434f5b;">Top Places to Visit in Sri Lanka</h2><br>
    <div class="row">
      <div class="col-md-4">
      <a href="province.php?id=1">
        <div class="card mb-4">
          <img src="assets/Galle-Face-Green.jpg" class="card-img-top" alt="Galle face" style="width: 100%; height: 200px;">
          <div class="card-body">
            <h5 class="card-title">Galle Face</h5>
            <p class="card-text">The Galle Face Green is a beautiful beach park in Colombo.</p>
          </div>
        </div>
      </a>
      </div>
      <div class="col-md-4">
      <a href="province.php?id=2">
        <div class="card mb-4">
          <img src="assets/knuckles-mountain-range.jpg" class="card-img-top" alt="Knuckles" style="width: 100%; height: 200px;">
          <div class="card-body">
            <h5 class="card-title">Knuckles Mountain</h5>
            <p class="card-text">Knuckles Mountain range is an unusual terrestrial landform located in Matale and Kandy.</p>
          </div>
        </div>
      </a>
      </div>
      <div class="col-md-4">
      <a href="province.php?id=2">
        <div class="card mb-4">
          <img src="assets/Sigiriya Rock.jpg" class="card-img-top" alt="Sigiriya" style="width: 100%; height: 200px;">
          <div class="card-body">
            <h5 class="card-title">Sigiriya</h5>
            <p class="card-text">Sigiriya Rock or the Lion Rock is an ancient fort located in the Matale District in central Sri Lanka.</p>
          </div>
        </div>
      </a>
      </div>
      <div class="col-md-4">
      <a href="province.php?id=3">
        <div class="card mb-4">
          <img src="assets/Arugam Bay.jpg" class="card-img-top" alt="Arugam bay" style="width: 100%; height: 200px;">
          <div class="card-body">
            <h5 class="card-title">Arugam bay</h5>
            <p class="card-text">The Sri Lankan coastal town of Arugam Bay lies on the Indian Ocean, 320 kilometers from the capital city Colombo.</p>
          </div>
        </div>
      </a>
      </div>
      <div class="col-md-4">
      <a href="province.php?id=5">
        <div class="card mb-4">
          <img src="assets/fort.jpg" class="card-img-top" alt="Jaffna fort" style="width: 100%; height: 200px;">
          <div class="card-body">
            <h5 class="card-title">Jaffna Fort</h5>
            <p class="card-text">Long the gatehouse of the city, the vast Jaffna fort, overlooking the Jaffna lagoon, has been fought over for centuries.
          </div>
        </div>
      </a>
      </div>
      <div class="col-md-4">
      <a href="province.php?id=2">
        <div class="card mb-4">
          <img src="assets/Royal botanical gardens Peradeniya.webp" class="card-img-top" alt="Peradeniya" style="width: 100%; height: 200px;">
          <div class="card-body">
            <h5 class="card-title">Royal botanical gardens Peradeniya</h5>
            <p class="card-text">The most prominent garden in Sri Lanka, Royal Botanical Gardens is situated 5 km west of Kandy.</p>
          </div>
        </div>
      </a>
      </div>
    </div>
  </section>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa fa-arrow-up"></i></a>
  <footer class="bg-dark text-white py-4 mt-5 text-center">
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
            <li><a href="#">Home</a></li>
            <li><a href="plan.php">Plan your visit</a></li>
            <li><a href="todo.php">My Journey</a></li>
          </ul>
        </div>
      </div>
      <div>
        <p>&copy; 2023 Designed By <a href="https://github.com/CodeCrafterz-TourWise"><i>CODE CRAFTERZ</i></a></p>
      </div>
    </div>
  </footer>
  <script>
    function scrollToSection(sectionId) {
      const targetSection = document.getElementById(sectionId);
      const navbarHeight = document.getElementById('navbar').offsetHeight;

      if (targetSection) {
        const offsetTop = targetSection.offsetTop - navbarHeight;
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      }
    }
  </script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>