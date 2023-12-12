<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: login.php');
    exit();
} else {
    include 'koneksi.php';

    $id = $_GET['id'];

    $query_pr = "SELECT * FROM pr_po_list WHERE id = '$id'";
    $result_pr = mysqli_query($conn, $query_pr);
    $row_pr = mysqli_fetch_assoc($result_pr);

    $query_items = "SELECT * FROM item_detail WHERE id_po = '$id'";
    $result_items = mysqli_query($conn, $query_items);

    $sub_total = 0; // Inisialisasi subtotal

    while ($row_item = mysqli_fetch_assoc($result_items)) {
        $sub_total += $row_item['total_price']; // Menambahkan total harga item ke subtotal
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
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php include "navbar.php"; ?>
            <?php include "sidebar_manager.php"; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <?php
                            $title = 'Purchase Order Details - ' . $row_pr['po_code'];

                            echo '<h3 class="card-title">' . $title . '</h3>';
                            ?>
                            <div class="card-tools">
                                <button class="btn btn-default printButton" data-id="<?= $row_pr['id']; ?>">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                <a class="btn btn-secondary" href="receiving_manager.php"><span
                                        class="fas fa-arrow-left"></span> Back</a>
                            </div>
                        </div>

                        <div class="card-body" id="print_out">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-danger">P.R. Code</label>
                                        <div>
                                            <?php echo $row_pr['po_code']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label text-danger">Supplier</label>
                                            <div>
                                                <?php
                                                include "koneksi.php";

                                                $id = $_GET['id'];

                                                $query = "SELECT pr.*, s.name AS supplier FROM pr_po_list pr
                      INNER JOIN supplier_list s ON pr.supplier = s.supplier_id
                      WHERE pr.id = '$id'";

                                                $result = mysqli_query($conn, $query);
                                                $row_pr = mysqli_fetch_assoc($result);

                                                echo $row_pr['supplier'];
                                                ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-danger">Date Created</label>
                                        <div>
                                            <?php echo $row_pr['date_created']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label text-danger">Department</label>
                                            <div>
                                                <?php echo $row_pr['department']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-danger">Item Requests</h4>
                                <table class="table table-striped table-bordered" id="list">
                                    <colgroup>
                                        <col width="10%">
                                        <col width="30%">
                                        <col width="10%">
                                        <col width="25%">
                                        <col width="25%">
                                    </colgroup>
                                    <thead>
                                        <tr class="text-light bg-gray">
                                            <th class="text-center py-1 px-2">Qty</th>
                                            <th class="text-center py-1 px-2">Item</th>
                                            <th class="text-center py-1 px-2">Unit</th>
                                            <th class="text-center py-1 px-2">Cost</th>
                                            <th class="text-center py-1 px-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $qry = $conn->query("SELECT d.*, i.name FROM item_detail d INNER JOIN item_list i ON d.item = i.item_id WHERE d.id_po = '$id'");
                                        while ($row = $qry->fetch_assoc()):
                                            $total += $row['total_price'];
                                            ?>
                                            <tr>
                                                <td class="py-1 px-2 text-center">
                                                    <?php echo $row['qty']; ?>
                                                </td>
                                                <td class="py-1 px-2 text-left">
                                                    <?php echo $row['name']; ?>
                                                </td>
                                                <td class="py-1 px-2 text-center">
                                                    <?php echo $row['unit']; ?>
                                                </td>
                                                <td class="py-1 px-2 text-right">
                                                    <?php echo number_format($row['cost'], 0, '.', '.'); ?>
                                                </td>
                                                <td class="py-1 px-2 text-right">
                                                    <?php echo number_format($row['total_price'], 0, '.', '.'); ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th class="text-right py-1 px-2" colspan="4">Sub Total</th>
                                            <th class="text-right py-1 px-2 sub-total">
                                                <?php echo number_format($sub_total, 0, '.', '.'); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-right py-1 px-2" colspan="4">Discount
                                                <?php echo $row_pr['discount_perc']; ?> %
                                            </th>
                                            <th class="text-right py-1 px-2 discount">
                                                <?php echo number_format($row_pr['discount_amount'], 0, '.', '.'); ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th class="text-right py-1 px-2" colspan="4">Tax
                                                <?php echo $row_pr['tax_perc']; ?> %
                                            </th>
                                            <th class="text-right py-1 px-2 tax">
                                                <?php echo number_format($row_pr['tax_amount'], 0, '.', '.'); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-right py-1 px-2" colspan="4">Total</th>
                                            <th class="text-right py-1 px-2 grand-total">
                                                <?php echo number_format($row_pr['total'], 0, '.', '.'); ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remarks" class="text-danger control-label">Remarks</label>
                                            <p>
                                                <?php echo $row_pr['remarks']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-danger">
                                            <?php echo strtoupper($row_pr['status']); ?>
                                        </span>
                                    </div>
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
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="../../dist/js/demo.js"></script> -->
        <script>
            const printButtons = document.querySelectorAll('.printButton');

            printButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');

                    window.open(`print_prr.php?id=${id}`, '_blank');
                });
            });
        </script>
    </body>

    </html>

    <?php
}
?>