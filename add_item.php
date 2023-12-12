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
                            <h3 class="card-title">Add New Item</h3>
                            <div class="card-tools">
                                <a href="list_item.php" class="btn btn-secondary btn-md"><span
                                        class="fas fa-arrow-left"></span> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group col-6">
                                        <label for="name">Item</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Item Name">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="unit">Unit</label>
                                        <select name="unit" id="unit" class="custom-select select2" required>
                                            <option value="">Select Unit</option>
                                            <option value="pcs">pcs</option>
                                            <option value="pack">pack</option>
                                            <option value="can">can</option>
                                            <option value="kg">kg</option>
                                            <option value="ltr">ltr</option>
                                            <option value="mtr">mtr</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="type">Types of Item</label>
                                        <select name="type" id="type" class="custom-select select2">
                                            <option value="">Select Type</option>
                                            <option value="chemical">chemical</option>
                                            <option value="food">food</option>
                                            <option value="baverage">beverage</option>
                                            <option value="stationery">stationery</option>
                                            <option value="aminities">aminities</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="cost">Cost</label>
                                        <input type="number" name="cost" class="form-control" id="cost"
                                            placeholder="Enter Cost">
                                    </div>
                                    <br>
                                    <button class="btn btn-danger" type="submit" name="submit">Save</button>
                                </form>
                            </div>
                        </div>
                        <?php
                        include "koneksi.php";

                        if (isset($_POST["submit"])) {
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $unit = $_POST['unit'];
                            $type = $_POST['type'];
                            $cost = $_POST['cost'];

                            $query = "INSERT INTO item_list (item_id, name, unit, type, cost) VALUES (null, '$name', '$unit', '$type', '$cost')";

                            $sql = mysqli_query($conn, $query) or die
                                (mysqli_error($conn));

                            if ($result) {
                                echo "<script>
                                        Swal.fire({
                                            title: 'Inserted!',
                                            text: 'Item Saved Success.',
                                            icon: 'success'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'list_item.php';
                                            }
                                        });
                                    </script>";
                            } else {
                                echo "<script>
                                            swal.fire({
                                                title: 'Error!',
                                                text: 'Failed to save item. Please try again.',
                                                icon: 'error',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = 'add_item.php';
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