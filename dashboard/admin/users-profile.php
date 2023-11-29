<?php
include("../../includes/sessions.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UserPanel- TourWise</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/Logo.png" rel="icon">
  <link href="../../assets/img/Logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../../assets/css/style.css" rel="stylesheet">
  <style>
    .hide-user-id {
      display: none;
    }
  </style>
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
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" href="user_management.php">
          <i class="bi bi-layout-text-window-reverse"></i><span>User Management</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#tables-nav" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Profile</span>
        </a>
      </li>


  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <!-- Profile Details Section -->
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <!-- Full Name -->
                  <div class="row hide-user-id">
                    <div class="col-lg-3 col-md-4 label">User Id</div>
                    <div class="col-lg-9 col-md-8">
                      <span id="user_id"><?php echo htmlspecialchars($login_id); ?></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8">
                      <span id="fullname"><?php echo htmlspecialchars($login_session); ?></span>
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">
                      <span id="email"><?php echo htmlspecialchars($login_email); ?></span>
                    </div>
                  </div>

                  <!-- Username -->
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8">
                      <span id="username"><?php echo htmlspecialchars($login_username); ?></span>
                    </div>
                  </div>

                  <!-- Inside the Profile Details Section -->
                  <div class="text-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profile-edit">Edit Profile</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#change-password">Change Password</button>
                  </div>


                  <!-- Edit Profile Modal -->
                  <div class="modal fade" id="profile-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <!-- Add name attribute to the form -->
                          <form id="edit-profile-form" action="../../includes/profile_update.php" method="post" name="edit-profile-form">
                            <div class="mb-3 hide-user-id">
                              <label for="edit-id" class="form-label">User ID</label>
                              <input type="text" name="edit_id" class="form-control" id="edit-user-id" name="user_id" value="<?php echo htmlspecialchars($login_id); ?>">
                            </div>
                            <div class="mb-3">
                              <label for="edit-fullname" class="form-label">Full Name</label>
                              <input type="text" class="form-control" id="edit-name" name="name" value="<?php echo htmlspecialchars($login_session); ?>">
                            </div>
                            <div class="mb-3">
                              <label for="edit-email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="edit-email" name="email" value="<?php echo htmlspecialchars($login_email); ?>">
                            </div>
                            <div class="mb-3">
                              <label for="edit-username" class="form-label">Username</label>
                              <input type="text" class="form-control" id="edit-username" name="username" value="<?php echo htmlspecialchars($login_username); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Save Changes</button>

                            <div class="alert-bg-success" id="message">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Change Password Modal -->
                <div class="modal fade" id="change-password" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Add name attribute to the form -->
                        <form id="change-password-form" action="../../includes/change_password.php" method="post" name="change-password-form">
                          <div class="mb-3">
                            <label for="current-password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current-password" name="current_password" required>
                          </div>
                          <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" required>
                          </div>
                          <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                          </div>
                          <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>

                          <div class="alert-bg-success" id="change-password-message">
                            <!-- Display change password success/failure messages here -->
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>




              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>