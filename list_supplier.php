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
                                <h1 style=" font-weight: bold;">Supplier List</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Supplier List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">List of Suppliers</h3>
                            <div class="card-tools">
                                <a href="add_supplier.php" class="btn btn-danger btn-md"><span class="fas fa-plus"></span>
                                    Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="container-fluid">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="20%">
                                            <col width="20%">
                                            <col width="20%">
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Supplier</th>
                                                <th>Address</th>
                                                <th>Contact Person</th>
                                                <th>Contact</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "koneksi.php";

                                            $query = "SELECT * FROM supplier_list ORDER BY 'id' desc";

                                            $data = mysqli_query($conn, $query)
                                                or die($conn);

                                            $no = 1;
                                            while ($row = mysqli_fetch_array($data)) {
                                                echo "<tr>";
                                                echo "<td>" . $no . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['address'] . "</td>";
                                                echo "<td>" . $row['cperson'] . "</td>";
                                                echo "<td>" . $row['contact'] . "</td>";
                                                ?>
                                                <td align="center">
                                                    <a type="button" class="btn btn-dark btn-md"
                                                        href="edit_supplier.php?supplier_id=<?= $row[0] ?>"><span
                                                            class="fa fa-edit" data-toggle="tooltip" data-placement="top"
                                                            title="Edit"></span>
                                                    </a>
                                                    <a type="button" class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#myModal"><span class="fa fa-eye" data-toggle="tooltip"
                                                            data-placement="top" title="View"></span>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure to delete this supplier?')"
                                                        type="button" class="btn btn-danger btn-md"
                                                        href="delete_supplier.php?supplier_id=<?= $row[0] ?>"><span
                                                            class="fa fa-trash" data-toggle="tooltip" data-placement="top"
                                                            title="Delete"></span>
                                                    </a>
                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" align="left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalLabel"><span
                                                                            class="fa fa-truck-loading"></span> Supplier Details
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <fieldset class="w-100">
                                                                            <div class="col-12">
                                                                                <dl>
                                                                                    <dt class="text-danger">Supplier Name :</dt>
                                                                                    <dd class="pl-3" id="name"></dd>
                                                                                    <dt class="text-danger">Address :</dt>
                                                                                    <dd class="pl-3" id="address"></dd>
                                                                                    <dt class="text-danger">Contact Person :
                                                                                    </dt>
                                                                                    <dd class="pl-3" id="cperson"></dd>
                                                                                    <dt class="text-danger">Contact :</dt>
                                                                                    <dd class="pl-3" id="contact"></dd>
                                                                                </dl>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal"
                                                                            id="myModalCloseBtn">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                echo "</tr>";
                                                $no++;
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php include "footer.php"; ?>
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
        <!-- Page specific script -->
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

            $(document).ready(function () {
                $('#example1').on('click', 'a.btn-info', function () {
                    var row = $(this).closest('tr');
                    var name = row.find('td:nth-child(2)').text();
                    var address = row.find('td:nth-child(3)').text();
                    var cperson = row.find('td:nth-child(4)').text();
                    var contact = row.find('td:nth-child(5)').text();

                    $('#myModal #name').text(name);
                    $('#myModal #address').text(address);
                    $('#myModal #cperson').text(cperson);
                    $('#myModal #contact').text(contact);

                    $('#myModal').modal('show');
                });

                $('#myModalCloseBtn').on('click', function () {
                    $('#myModal').modal('hide');
                });
            });

        </script>
    </body>

    </html>

    <?php
}
?>