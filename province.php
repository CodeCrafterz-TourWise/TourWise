<?php
    include('includes/config.php');

    if (isset($_GET['id'])) {
        $provinceId = $_GET['id'];
    }

    // retrieve the province 
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

    // Retrieve nearby tour guides
    $guideQuery = "SELECT * FROM tour_guides WHERE p_id = $provinceId";
    $guidesResult = mysqli_query($con, $guideQuery);

    // Fetch the tour guides data
    $guides = [];
    while ($guide = mysqli_fetch_assoc($guidesResult)) {
        $guides[] = $guide;
    }
    // Retrieve comments with user names
    $commentsQuery = "SELECT comments.*, users.name as user_name FROM comments
                    JOIN users ON comments.u_id = users.user_id
                    WHERE pro_id = $provinceId";
    $commentsResult = mysqli_query($con, $commentsQuery);

    // Fetch the comments data with user names
    $comments = [];
    while ($comment = mysqli_fetch_assoc($commentsResult)) {
        $comments[] = $comment;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $provinceData['p_name']; ?> Province</title>
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      a{
        text-decoration:none;
      }
      .card-body{
        color:#434f5b;
        background-color: #dbe6e2;
      }
      h2{
        color:#434f5b;
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
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="plan.php">Plan your visit</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="todo.php">Todo</a>
                </li>
            </ul>
            <?php
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
                    echo '<div>';
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


    <div class="container mt-5 p-3">
        <h2>Explore <?php echo $provinceData['p_name']; ?> Province</h2>
        <div class="row mt-4">
            <?php
            foreach ($places as $place) {
            ?>
                <div class="col-md-3 mb-4">
                <div class="card">
                <img src="./assets/<?php echo $place['pcImg']; ?>" class="card-img-top" alt="<?php echo $place['pc_name']; ?>" style="width: 100%; height: 200px;">
        
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $place['pc_name']; ?></h5>
                        <p class="card-text"><?php echo $place['disc']; ?></p>
                    </div>
                </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

        <div class="container">
        <div class="row">
            <div class="col-md-6 mt-4">
                <div id="map" style="height: 350px;width: auto;"></div>
            </div>
            <div class="col-md-6 mt-4 p-3" style="background-color: rgb(219, 230, 226);border-radius: 10px;">
                <h3>Nearby Tour Guides</h3>
                <div class="row">
                    <?php
                    foreach ($guides as $guide) {
                    ?>
                        <div class="col-md-5 mb-3">
                            <strong><?php echo $guide['guide_name']; ?></strong><br>
                            Phone: <?php echo $guide['phone']; ?><br>
                            Email: <?php echo $guide['email']; ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--comment section-->
    <h2 class="container mt-5">Share your feedbacks about your travel experience</h2>

    <div id="comments" class="container mt-4 p-3" style="background-color: rgb(219, 230, 226); border-radius: 10px;">
        <form id="commentForm" action="save_comment.php?id=<?php echo $provinceId; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="commentText" class="form-label">Comment here (Max 170 characters):</label>
                <textarea class="form-control" id="commentText" name="commentText" rows="3" maxlength="170" required></textarea>
            </div>

            <div class="mb-3">
                <label for="commentImage" class="form-label">Image (Upload from device):</label>
                <input type="file" class="form-control" id="commentImage" accept=".jpg, .jpeg, .png" name="commentImage" required>
            </div>

            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>

    <!-- Display comments -->
    <div class="container mt-5 p-3" style="background-color: rgb(219, 230, 226); border-radius: 10px;">
        <h2>Comments</h2>
        <div class="row">
            <?php
            foreach ($comments as $comment) {
            ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"><?php echo $comment['c_text']; ?></p>
                            <p class="card-text"><strong>Posted by:</strong> <?php echo $comment['user_name']; ?></p>
                            <?php
                            if (!empty($comment['c_image'])) {
                                echo '<img src="' . $comment['c_image'] . '" class="img-fluid" alt="Comment Image">';
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['login_user'])) {
                                // Storing Session
                                $user_check = $_SESSION['login_user'];

                                // SQL Query To Fetch Complete Information Of User
                                $ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
                                $row = mysqli_fetch_assoc($ses_sql);
                                $login_id = $row['user_id'];
                                // Display delete button only if the logged-in user is the owner of the comment
                                if ($comment['u_id'] == $login_id) {
                                    echo '<a href="delete_comment.php?comment_id=' . $comment['comment_id'] . '&province_id=' . $provinceId . '" class="btn btn-danger mt-2">Delete</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


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
                      <li><a href="index.php">Home</a></li>
                      <li><a href="plan.php">Plan your visit</a></li>
                      <li><a href="todo.php">Todo</a></li>
                  </ul>
              </div>
          </div>
          <div>
            <p>&copy; 2023 Designed By <a href="https://github.com/CodeCrafterz-TourWise"><i>CODE CRAFTERZ</i></a></p>
          </div>
      </div>
    </footer>
   
    <?php
    // Function to fetch locations based on p_id
    function getLocations($conn, $provinceId)
    {
        $locations = [];
        $result = mysqli_query($conn, "SELECT * FROM map WHERE p_id = $provinceId");
        while ($row = mysqli_fetch_assoc($result)) {
            $locations[] = [
                'lat' => $row['lat'],
                'lng' => $row['lng'],
                'info' => $row['plcName'],
            ];
        }
        return $locations;
    }

    // Fetch locations based on the province ID
    $locations = getLocations($con, $provinceId);
    ?>

    <script>
        function initMap() {
        // Map options (centered on a specific Place)
        const mapOptions = {
            center: { lat: 7.789974956093105, lng: 80.68075651949748 }, // Example center point
            zoom: 7, // zoom level
        };      

        // Create a map 
        const map = new google.maps.Map(document.getElementById("map"), mapOptions);

        // Add markers 
        const locationsData = <?php echo json_encode($locations); ?>;
        console.log(locationsData); // the console for debugging

        for (const location of locationsData) {
            const lat = parseFloat(location.lat); 
            const lng = parseFloat(location.lng); 

            if (!isNaN(lat) && !isNaN(lng)) {
                const marker = new google.maps.Marker({
                    position: { lat, lng },
                    map: map,
                    title: location.info,
                });
            } else {
                console.error('Invalid latitude or longitude:', location);
            }
        }
        }

        // Ensure that the initMap function is called when the API is loaded
        function loadMapScript() {
            const script = document.createElement("script");
            script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDnNPxaYAj-7FHjdLMpvhCxdVhQN7Dt0fc&callback=initMap";
            script.defer = true;
            document.body.appendChild(script);
        }

        // Load the map script
        loadMapScript();

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</body>
</html>
