<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Purchasing & Receiving System</title>
  <link rel="icon" href="assets/logo.png" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" -->
  <!-- integrity="sha512-k9W5mAYdp7eTDPL2kq8vHMkRoELs3bT58qJKTeZmGt62EeCwVmYls1Xm0lDxDRF4HBbQuIXwx/bzRUWQREjkg==" -->
  <!-- crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script> -->
  <script src="admin/plugins/select2/js/select2.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <script src="./plugins/sweet-alert/sweetalert.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition login-page dark-mode">
  <style>
    body {
      background-image: url("assets/neo+.jpg");
      background-size: cover;
      background-repeat: no-repeat;
    }

    .login-title {
      text-shadow: 2px 2px black
    }
  </style>
  <h1 class="text-center py-5 login-title"><b>Purchasing & Receiving System</b></h1>
  <div class="login-box">
    <div class="card card-outline card-danger">
      <div class="card-header text-center">
        <h1><b>Login</b></h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Login to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" autofocus placeholder="Enter Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Enter Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div><br>
          <div class="row justify-content-end">
            <div class="col-12">
              <button type="submit" name="submit" class="btn btn-danger btn-block">Login</button>
            </div>
          </div>
        </form>
        <?php
        session_start();
        include "koneksi.php";

        if (isset($_POST['submit'])) {
          $username = $_POST['username'];
          $password = md5($_POST['password']);

          $sql = "SELECT * FROM user_list WHERE username='$username' && password='$password'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          if ($row) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['type'] = $row['type'];

            switch ($_SESSION['type']) {
              case 'Admin':
                echo "<script>
                        Swal.fire({
                            title: 'Success Login!',
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'home_admin.php';
                            }
                        });
                    </script>";
                break;

              case 'Super Admin':
                echo "<script>
                        Swal.fire({
                            title: 'Success Login!',
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'home_super.php';
                            }
                        });
                    </script>";
                break;

              case 'Manager':
                echo "<script>
                        Swal.fire({
                            title: 'Success Login!',
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'home_manager.php';
                            }
                        });
                    </script>";
                break;
            }
          } else {
            ?>
            <script>
              Swal.fire({
                title: 'Invalid Username or Password',
                icon: 'error'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'login.php';
                }
              });
            </script>
            <?php
          }
        }
        ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>