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

        <!-- Tautan ke Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

        <!-- Tautan ke Bootstrap JavaScript (wajib memuat jQuery sebelum Bootstrap) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

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
            <?php include "sidebar_super.php"; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 style=" font-weight: bold;">User List</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
                                    <li class="breadcrumb-item active">User List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">List of System Users</h3>
                            <div class="card-tools">
                                <a href="add_user.php" class="btn btn-danger btn-md"><span class="fas fa-plus"></span> Add
                                    New</a>
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
                                            <col width="15%">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Avatar</th>
                                                <th>Username</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "koneksi.php";

                                            $query = "SELECT * FROM user_list ORDER BY username asc";

                                            $data = mysqli_query($conn, $query)
                                                or die($conn);

                                            $no = 1;
                                            while ($row = mysqli_fetch_array($data)) {
                                                echo "<tr>";
                                                echo "<td>" . $no . "</td>";
                                                echo '<td><img src="assets/' . $row['avatar'] . '" class="profile-image img-circle border-5" width="50" height="50" alt=""></td>';
                                                echo "<td>" . $row['username'] . "</td>";
                                                echo "<td>" . $row['type'] . "</td>";
                                                ?>
                                                <td align="center">
                                                    <a type="button" class="btn btn-dark btn-md"
                                                        href="edit_user.php?user_id=<?= $row[0] ?>"><span class="fa fa-edit"
                                                            data-toggle="tooltip" data-placement="top" title="Edit"></span>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure to delete this system user?')"
                                                        type="button" class="btn btn-danger btn-md"
                                                        href="delete_user.php?user_id=<?= $row[0] ?>"><span class="fa fa-trash"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"></span>
                                                    </a>
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
        <script src="dist/js/demo.js"></script>
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
        </script>
    </body>

    </html>

    <?php
}
?>