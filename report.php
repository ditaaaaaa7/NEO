<?php
session_start();
if (empty($_SESSION['username'])) {
    ?>
    <script language='javascript'>
        alert('Silahkan login terlebih dahulu');
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
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 style=" font-weight: bold;">Receiving Reports</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
                                    <li class="breadcrumb-item">Receiving reports</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">List of Receiving Reports</h3>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form method="POST" id="printForm">
                                    <div class="row">
                                        <div class="col form-group">
                                            <label for="month" class="font-weight-bold">Months :</label>
                                            <select name="month" class="form-control">
                                                <option value="">Choose Month</option>
                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label for="year" class="font-weight-bold">Years :</label>
                                            <select name="year" class="form-control">
                                                <option selected="">Choose Year</option>
                                                <?php
                                                $now = date('Y');
                                                for ($a = 2022; $a <= $now; $a++) {
                                                    echo "<option value='$a'>$a</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col form-group">
                                            <label for="supplier" class="font-weight-bold">Suppliers :</label>
                                            <select name="supplier" class="custom-select select2">
                                                <option selected="">Choose Supplier</option>
                                                <?php
                                                include 'koneksi.php';

                                                $query = "SELECT supplier_id, name FROM supplier_list";
                                                $result = mysqli_query($conn, $query);

                                                if ($result) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='{$row['supplier_id']}'>{$row['name']}</option>";
                                                    }
                                                } else {
                                                    echo "Failed to fetch suppliers.";
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <a class="btn btn-secondary" id="filterBtn" disabled>Show</a>
                                    <button class="btn btn-danger" data-id="<?= $row_pr['id']; ?>" id="printBtn">
                                        Print
                                    </button>
                                </form>
                            </div>
                            <br>
                            <div class="container-fluid">
                                <table class="table table-bordered table-stripped">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="15%">
                                        <col width="20%">
                                        <col width="25%">
                                        <col width="20%">
                                    </colgroup>
                                    <thead>
                                        <tr class="text-left">
                                            <th>#</th>
                                            <th>Date Created</th>
                                            <th>P.O. Code</th>
                                            <th>Supplier</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2023.</strong> All rights reserved
            </footer>

            <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="dist/js/demo.js"></script> -->
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            function cekFilter() {
                const month = document.getElementById('month').value;
                const year = document.getElementById('year').value;
                const supplier = document.getElementById('supplier').value;

                const filterBtn = document.getElementById('filterBtn');
                const printBtn = document.getElementById('printBtn');

                if (month && year && supplier) {
                    filterBtn.removeAttribute('disabled');
                    printBtn.removeAttribute('disabled');
                } else {
                    filterBtn.setAttribute('disabled', true);
                    printBtn.setAttribute('disabled', true);
                }
            }

            document.getElementById("filterBtn").addEventListener("click", function () {
                var selectedMonth = document.querySelector("[name=month]").value;
                var selectedYear = document.querySelector("[name=year]").value;
                var selectedSupplier = document.querySelector("[name=supplier]").value;

                $.ajax({
                    method: "POST",
                    url: "get_filtered_data.php",
                    data: {
                        month: selectedMonth,
                        year: selectedYear,
                        supplier: selectedSupplier
                    },
                    success: function (response) {
                        var tableBody = document.querySelector("tbody");
                        tableBody.innerHTML = response;
                    }
                });
            });

            $(function () {
                const printBtn = document.getElementById("printBtn");

                printBtn.addEventListener('click', handlePrintBtnClick);

                function handlePrintBtnClick() {
                    var selectedMonth = document.querySelector("[name=month]").value;
                    var selectedYear = document.querySelector("[name=year]").value;
                    var selectedSupplier = document.querySelector("[name=supplier]").value;

                    if (selectedMonth !== "" && selectedYear !== "" && selectedSupplier !== "") {
                        window.open(`print_report.php?month=${selectedMonth}&year=${selectedYear}&supplier=${selectedSupplier}`, '_blank');
                    } else {
                        alert("Please select month, year, and supplier before printing.");
                    }

                    printBtn.removeEventListener('click', handlePrintBtnClick);
                }
            });
        </script>
    </body>

    </html>

    <?php
}
?>