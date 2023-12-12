<?php
session_start();
//periksa apakah user telah login atau memiliki session
if (empty($_SESSION['username'])) {
    ?>
    <script language='javascript'>
        alert('Silahkan login terlebih dahulu');
        document.location = 'login.php'
    </script>

    <?php
} else {
    include "koneksi.php";

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $query = "UPDATE item_detail SET item = 'Item', qty=10 WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {

        } else {
        }
    }

    $queryReceiveItems = "SELECT item_list.name AS item, COUNT(*) as total
                      FROM pr_po_list
                      JOIN item_detail ON pr_po_list.id = item_detail.id_po
                      JOIN item_list ON item_detail.item = item_list.item_id
                      WHERE pr_po_list.status IN ('Receive', 'Partially Receive')
                      GROUP BY item_list.name";
    $resultReceiveItems = mysqli_query($conn, $queryReceiveItems);

    $labels = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($resultReceiveItems)) {
        $labels[] = $row['item'];
        $data[] = $row['total'];
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php include "navbar.php"; ?>
            <?php include "sidebar_admin.php"; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 style=" font-weight: bold;">Dashboard</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Home</li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                        <hr>
                    </div>
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <!-- Default box -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title" id="greeting"></h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>Welcome to Purchasing & Receiving System.</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <div class="info-box bg-light shadow">
                                                    <span class="info-box-icon bg-gray elevation-1"><i
                                                            class="fas fa-file"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">PR Records</span>
                                                        <span class="info-box-number text-right">
                                                            <?php
                                                            echo $conn->query("SELECT * FROM `pr_po_list` WHERE `status` = 'Pending'")->num_rows;
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <div class="info-box bg-light shadow">
                                                    <span class="info-box-icon bg-green elevation-1"><i
                                                            class="fas fa-th-list"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">PO Records</span>
                                                        <span class="info-box-number text-right">
                                                            <?php
                                                            echo $conn->query("SELECT * FROM `pr_po_list` WHERE `status` = 'Process'")->num_rows;
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <div class="info-box bg-light shadow">
                                                    <span class="info-box-icon bg-warning elevation-1"><i
                                                            class="fas fa-boxes"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Receiving Records</span>
                                                        <span class="info-box-number text-right">
                                                            <?php
                                                            echo $conn->query("SELECT * FROM `pr_po_list` WHERE `status` IN ('Receive', 'Partially Receive')")->num_rows;
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <div class="info-box bg-light shadow">
                                                    <span class="info-box-icon bg-purple elevation-1"><i
                                                            class="fas fa-folder"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Receiving Reports</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <div class="info-box bg-light shadow">
                                                    <span class="info-box-icon bg-navy elevation-1"><i
                                                            class="fas fa-truck-loading"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Suppliers</span>
                                                        <span class="info-box-number text-right">
                                                            <?php
                                                            echo $conn->query("SELECT * FROM `supplier_list`")->num_rows;
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-3">
                                                <div class="info-box bg-light shadow">
                                                    <span class="info-box-icon bg-lightblue elevation-1"><i
                                                            class="fas fa-book"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Items</span>
                                                        <span class="info-box-number text-right">
                                                            <?php
                                                            echo $conn->query("SELECT * FROM `item_list`")->num_rows;
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer"
                                        style="text-align: center; display: flex; align-items: center; justify-content: center;">
                                        <img src="assets/neo.jpg"
                                            style="max-width: 100px; max-height: 100px; margin-right: 20px;">
                                        <h6 style="margin: 0; text-align: center;">Komplek Taman Budaya Sentul City, Jl.
                                            Siliwangi No.1,
                                            Babakan Madang, Bogor, Jawa Barat, 16710</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <br>
                <div style="width: 80%; margin: 0 auto;">
                    <canvas id="itemChart"></canvas>
                </div>
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
            var time = new Date().getHours();

            var greeting;
            if (time < 12) {
                greeting = "Good Morning";
            } else if (time < 17) {
                greeting = "Good Afternoon";
            } else {
                greeting = "Good Evening";
            }

            var username = "<?php echo $_SESSION['username']; ?>";
            var fullGreeting = greeting + ", " + username;

            document.getElementById("greeting").textContent = fullGreeting;
        </script>
        <script>
            var ctx = document.getElementById('itemChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        label: 'Frequently Purchased Items',
                        data: <?php echo json_encode($data); ?>,
                        borderColor: 'red',
                        borderWidth: 2
                    }]
                },
                options: {
                }
            });
        </script>
    </body>

    </html>

    <?php
}
?>