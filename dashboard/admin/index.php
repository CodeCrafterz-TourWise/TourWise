<?php
require_once('../../includes/sessions.php');
?>

<!DOCTYPE html>
<html lang="en"></html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AdminPanel- TourWise</title>

  <!-- Favicons -->
  <link href="../../assets/img/logo.png" rel="icon">
  <link href="../../assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="../../index.php" class="logo d-flex align-items-center">
        <img src="../../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Tour Wise</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo "$login_session" ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../index.php">
                <i class="bi bi-house"></i>
                <span>Home</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" href="user_management.php">
        <i class="bi bi-person-fill-gear"></i><span>User Management</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" href="users-profile.php">
          <i class="bi bi-layout-text-window-reverse"></i><span>Profile</span>
        </a>
      </li>
    </ul><!-- End Sidebar-->
  </aside>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <!-- ======= Event Update Form ======= -->
    <div class="container col-lg-12 mt-5">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Event Update</h2>
        <form action="post_event.php" method="post">
            <div class="mb-3">
                <label for="eventTitle" class="form-label">Event Title</label>
                <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
            </div>
            <div class="mb-3">
                <label for="eventDescription" class="form-label">Event Description</label>
                <textarea class="form-control" id="eventDescription" name="eventDescription" rows="3" required></textarea>
            </div>
            <!-- Include a hidden input for admin_id -->
            <input type="hidden" name="adminId" value="<?php echo $login_id; ?>">
            <button type="submit" class="btn btn-primary">Post Update</button>
        </form>
    </div>
    </div>
    <?php
    // Retrieve and display event updates
    $selectQuery = "SELECT * FROM events ORDER BY event_id DESC"; // Order by the most recent event first
    $result = mysqli_query($con, $selectQuery);

    echo '<div class="row">';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $eventId = $row['event_id'];
            $eventTitle = $row['title'];
            $eventDescription = $row['description'];

            // Display event update with edit and delete option

            echo '<div class="col-md-4 py-3">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo "<h3 class='card-title'>$eventTitle</h3>";
            echo "<p class='card-text'>$eventDescription</p>";


            // Check if the user is authorized to delete and edit
            if ($login_id == $row['admin_id']) {
                echo '<form action="delete_event.php" method="post" class="card-footer">';
                echo '<input type="hidden" name="eventId" value="' . $eventId . '">';
                // Edit button
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal' . $eventId . '">Edit</button>';
                echo '<button type="submit" class="btn btn-danger" style="float:right;">Delete</button>';
                echo '</form>';
            }

            echo '</div>';
            echo '</div>';
            echo '</div>';

            // Edit Modal
            echo '<div class="modal fade" id="editModal' . $eventId . '" tabindex="-1" aria-labelledby="editModalLabel' . $eventId . '" aria-hidden="true">';
            echo '<div class="modal-dialog">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="editModalLabel' . $eventId . '">Edit Event</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<form action="edit_event.php" method="post">';
            echo '<input type="hidden" name="eventId" value="' . $eventId . '">';
            echo '<div class="mb-3">';
            echo '<label for="editEventTitle" class="form-label">Event Title</label>';
            echo '<input type="text" class="form-control" id="editEventTitle" name="editEventTitle" value="' . $eventTitle . '" required>';
            echo '</div>';
            echo '<div class="mb-3">';
            echo '<label for="editEventDescription" class="form-label">Event Description</label>';
            echo '<textarea class="form-control" id="editEventDescription" name="editEventDescription" rows="3" required>' . $eventDescription . '</textarea>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No event updates available.</p>';
    }
    echo '</div>';
    ?>
  </div>
  </main>
  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>
