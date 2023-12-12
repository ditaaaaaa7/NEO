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
    include "koneksi.php";
    // Periksa apakah ada parameter ID yang dikirimkan melalui URL
    if (isset($_GET['supplier_id']) && $_GET['supplier_id'] > 0) {
        $supplier_id = $_GET['supplier_id'];
        $query = "SELECT * FROM supplier_list WHERE supplier_id = $supplier_id";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $address = $row['address'];
            $cperson = $row['cperson'];
            $contact = $row['contact'];
        } else {
            // Jika data supplier tidak ditemukan, alihkan ke halaman daftar supplier
            header("Location: list_supplier.php");
            exit();
        }
    } else {
        // Jika parameter ID tidak ditemukan, alihkan ke halaman daftar supplier
        header("Location: list_supplier.php");
        exit();
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
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php include "navbar.php"; ?>
            <?php

            $userType = "Admin";
            $username = "admin";

            include "sidebar_admin.php";

            if ($userType == "Admin" && $username == "admin") {
                include "sidebar_super.php";
            }
            ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Edit Supplier</h3>
                            <div class="card-tools">
                                <a href="list_supplier.php" class="btn btn-secondary btn-md"><span
                                        class="fas fa-arrow-left"></span> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form method="post" enctype="multipart/form-data" action="">
                                    <div class="form-group col-6">
                                        <label for="name">Supplier</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="<?php echo $name; ?>">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="<?php echo $address; ?>">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="cperson">Contact Person</label>
                                        <input type="text" name="cperson" id="cperson" class="form-control"
                                            value="<?php echo $cperson; ?>">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="contact">Contact</label>
                                        <input type="number" name="contact" class="form-control" id="contact"
                                            value="<?php echo $contact; ?>">
                                    </div>
                                    <br>
                                    <button class="btn btn-md btn-danger mr-2" type="submit" name="submit">Update</button>
                                </form>
                            </div>
                        </div>
                        <?php
                        include "koneksi.php";

                        if (isset($_POST["submit"])) {
                            $name = $_POST['name'];
                            $address = $_POST['address'];
                            $cperson = $_POST['cperson'];
                            $contact = $_POST['contact'];

                            $query = "UPDATE supplier_list SET name='$name', address='$address', cperson='$cperson', contact='$contact' WHERE supplier_id=$supplier_id";

                            $sql = mysqli_query($conn, $query) or die(mysqli_error($conn));

                            if ($result) {
                                echo "<script>
                                            Swal.fire({
                                                title: 'Inserted!',
                                                text: 'Supplier Updated Success.',
                                                icon: 'success'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = 'list_supplier.php';
                                                }
                                            });
                                        </script>";
                            } else {
                                echo "<script>
                                                swal.fire({
                                                    title: 'Error!',
                                                    text: 'Failed to update supplier. Please try again.',
                                                    icon: 'error',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = 'list_supplier.php';
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
    </body>

    </html>

    <?php
}
?>