<?php
// database connection 
$con = mysqli_connect("localhost", "root", "", "tourwise");

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_GET['id'])) {
    $provinceId = $_GET['id'];
}

// retrieved the province 
$query = "SELECT * FROM province WHERE p_id = $provinceId";
$result = mysqli_query($con, $query);

// Fetch the province data
$provinceData = mysqli_fetch_assoc($result);

// retrieved place and discription
$placeQuery = "SELECT place.*, discription.disc 
               FROM place 
               JOIN discription ON place.pcId = discription.pcId 
               WHERE place.p_id = $provinceId";

$placesResult = mysqli_query($con, $placeQuery);

// Fetch the places data
$places = [];
while ($place = mysqli_fetch_assoc($placesResult)) {
    $places[] = $place;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $provinceData['p_name']; ?> Province</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        a {
            text-decoration:none;
        }
        .card-body {
            color:#434f5b;
            background-color: rgb(240,246,255);
        }
        footer {
            text-align: center;
        }
    </style>

</head>
<body class="border-0 bd-example m-0 border-0" style="background-color: rgb(242, 244, 243);">
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
            <div class="d-grid gap-2 d-md-block text-center">
              <a href="../sign_in.html"><button class="btn btn-outline-light" type="button"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</button>
              </a>
            </div>
          </div>
      </div>
    </nav>


    <div class="container mt-5 p-3">
        <h2>Explore <?php echo $provinceData['p_name']; ?> Province</h2>
        <div class="row mt-4">
            <?php
            foreach ($places as $place) {
            ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                       
                        <h5 class="card-title"><?php echo $place['pc_name']; ?></h5>
                        <p class="card-text"><?php echo $place['disc']; ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <footer class="bg-dark text-white py-4" style="margin-top: 30px;">
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
                      <li><a href="../index.html">Home</a></li>
                      <li><a href="../plan.html">Plan your visit</a></li>
                      <li><a href="../todo.html">Todo</a></li>
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
</body>
</html>
