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
  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
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
            <a class="nav-link active" aria-current="page" href="#">Todo</a>
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
            /// If not logged in, redirect to login page using JavaScript
            echo '<script>window.location.href = "login_page.php";</script>';
            exit();
          }
          ?>
      </div>
    </div>
  </nav>

  <main>
    <div class="container py-5 py-5">
        <section class="section register min-vh-100 d-flex py-4">
            <div class="container">
                <!-- Form for adding a new task -->
                <form method="post" action="add_todo.php">
                    <div class="mb-3">
                        <label for="task" class="form-label">New Task:</label>
                        <input type="text" class="form-control" id="task" name="task" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>

                <!-- Display tasks from the database -->
                <div class="container py-5">
                    <?php
                    // checks user
                    include "includes/config.php";

                    // Storing Session
                    $user_check = $_SESSION['login_user'];

                    // SQL Query To Fetch Complete Information Of User
                    $ses_sql = mysqli_query($con, "select * from users where username='$user_check'");
                    $row = mysqli_fetch_assoc($ses_sql);
                    $login_id = $row['user_id'];

                    // Retrieve tasks from the database
                    $sql = "SELECT * FROM todos where u_id=$login_id";
                    echo "<div class='container'>";

                    echo "<table class='table datatable' style='margin-bottom: 20px;'>";
                    echo "<thead>";
                    echo "<tr><th scope='col'>Tasks</th>";
                    echo "<th scope='col'>Edit</th>";
                    echo "<th scope='col'>Delete</th></tr>";
                    echo "</thead>";

                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr><td>" . $row["task"] . "</td>";
                            echo "<td><div class='icon'></div><i class='bi bi-pencil-square'></i></td>";
                            echo "<td><div class='icon'></div><i class='bi bi-trash-fill'></i></td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No tasks found.</td></tr>";
                    }

                    // Close the table
                    echo "</table>";
                    ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
          </form>

          <div class="container py-5">
            <?php
            $sql = "SELECT * FROM todos";
            echo "<div class='container'>";

            echo "<table class='table datatable' style='margin-bottom: 20px;'>";
            echo "<thead>";
            echo "<tr><th scope='col'>Tasks</th>";
            echo "<th scope='col'>Edit</th>";
            echo "<th scope='col'>Delete</th>";
            echo "</thead>";

            $result = $con->query($sql);
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                $taskId = $row["id"];
                echo "<tr><td>" . $row["task"] . "</td>";
                echo "<td><button class='btn btn-primary edit-btn' data-task-id='$taskId'><i class='bi bi-pencil-square'></i> Edit</button></td>";
                echo "<td><button class='btn btn-danger delete-btn' data-task-id='$taskId'><i class='bi bi-trash-fill'></i> Delete</button></td></tr>";

                echo "<tr class='edit-form-row' id='edit-form-row-$taskId' style='display:none;'><td colspan='3'>";
                echo "<form method='post' action='todo_edit.php'>";
                echo "<input type='hidden' name='task_id' value='$taskId'>";
                echo "<div class='mb-3'>";
                echo "<label for='edited_task' class='form-label'>Edit Task:</label>";
                echo "<input type='text' class='form-control' id='edited_task' name='edited_task' value='" . $row["task"] . "' required>";
                echo "</div>";
                echo "<button type='submit' name='update' class='btn btn-success'>Update Task</button>";
                echo "</form>";
                echo "</td></tr>";
              }
            } else {
              echo "No tasks found.";
            }
            ?>
          </div>
        </div>
      </section>
    </div>
  </main>


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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Add event listener for edit button clicks
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
      button.addEventListener('click', function () {
        const taskId = this.getAttribute('data-task-id');
        // Hide all edit forms
        document.querySelectorAll('.edit-form-row').forEach(row => {
          row.style.display = 'none';
        });
        // Show the edit form for the clicked task
        const editFormRow = document.getElementById('edit-form-row-' + taskId);
        editFormRow.style.display = 'table-row';
      });
    });

    // Add event listener for delete button clicks
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
      button.addEventListener('click', async function () {
        const taskId = this.getAttribute('data-task-id');

        // Show a confirmation dialog
        const result = await Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
        });

        if (result.value) {
          try {
            // If the user clicks "Yes", proceed with the deletion
            const response = await fetch('delete_task.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'task_id=' + taskId,
            });

            if (!response.ok) {
              throw new Error('Network response was not ok');
            }

            const data = await response.json();

            // Handle the response
            console.log(data);

            // Show success message
            Swal.fire({
              title: 'Deleted!',
              text: 'Your task has been deleted.',
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok!',
            });

            // Reload the page after successful deletion
            location.reload();
          } catch (error) {
            console.error('Error:', error);
          }
        }
      });
    });
  });
</script>

</body>

</html>