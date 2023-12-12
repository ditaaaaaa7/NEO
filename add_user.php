<?php
session_start();
if (empty($_SESSION['username'])) {
    ?>
    <script language='javascript'>
        alert('Please Login First');
        document.location = 'login.php'
    </script>
    <?php
} else {
    $type = '';

    if (isset($_GET['user_id']) && $_GET['user_id'] > 0) {
        $user_id = $_GET['user_id'];
        $query = "SELECT type FROM user_list WHERE user_id = $user_id";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $type = $row['type'];
        }
    }
    ?>

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
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <script src="./plugins/sweet-alert/sweetalert.js"></script>
        <style>
            .with-border {
                border: 4px solid #CECECE;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php include "navbar.php"; ?>
            <?php include "sidebar_super.php"; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Add New System User</h3>
                            <div class="card-tools">
                                <a href="list_user.php" class="btn btn-secondary btn-md"><span
                                        class="fas fa-arrow-left"></span> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group col-6">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Enter Username">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Password">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="type">User Type</label>
                                        <select name="type" class="custom-select">
                                            <option value="">Select User Type</option>
                                            <?php
                                            $queryEnum = "SHOW COLUMNS FROM user_list WHERE Field = 'type'";
                                            $resultEnum = mysqli_query($conn, $queryEnum);

                                            if ($resultEnum) {
                                                $rowEnum = mysqli_fetch_assoc($resultEnum);
                                                $enumValues = explode("','", substr($rowEnum['Type'], 6, -2));

                                                foreach ($enumValues as $value) {
                                                    $selected = ($type == $value) ? 'selected' : '';
                                                    echo "<option value=\"$value\" $selected>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="avatar">Avatar</label>
                                        <div class="input-group">
                                            <input type="file" class="custom-file-input" name="avatar" id="avatarInput">
                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 d-flex justify-content-center">
                                        <img id="avatarPreview" class="profile-image img-circle with-border"
                                            style="width: 100px; height: 100px;">
                                    </div>
                                    <br>
                                    <button class="btn btn-danger" type="submit" name="submit">Save</button>
                                </form>
                            </div>
                        </div>


                        <?php
                        include "koneksi.php";

                        if (isset($_POST["submit"])) {
                            $username = $_POST['username'];
                            $password = md5($_POST['password']);
                            $type = $_POST['type'];

                            $nameavatar = $_FILES['avatar']['name'];
                            $lokasi = $_FILES['avatar']['tmp_name'];
                            move_uploaded_file($lokasi, "assets/" . $nameavatar);

                            $query = "INSERT INTO user_list (user_id, username, password, type, avatar) VALUES (null, '$username', '$password', '$type', '$nameavatar')";

                            $sql = mysqli_query($conn, $query) or die(mysqli_error($conn));

                            if ($result) {
                                echo "<script>
                                        Swal.fire({
                                            title: 'Inserted!',
                                            text: 'User Saved Success.',
                                            icon: 'success'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'list_user.php';
                                            }
                                        });
                                    </script>";
                            } else {
                                echo "<script>
                                            swal.fire({
                                                title: 'Error!',
                                                text: 'Failed to save user. Please try again.',
                                                icon: 'error',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = 'add_user.php';
                                                }
                                            });
                                        </script>";
                            }
                        }
                        ?>
                    </div>
                </section>
            </div>

            <?php include "footer.php"; ?>
        </div>

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="dist/js/demo.js"></script> -->
        <script>
            $('.custom-file-input').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });

            document.getElementById('avatarInput').addEventListener('change', function () {
                var fileInput = this;
                var avatarPreview = document.getElementById('avatarPreview');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        avatarPreview.setAttribute('src', e.target.result);
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        </script>
    </body>

    </html>

    <?php
}
?>