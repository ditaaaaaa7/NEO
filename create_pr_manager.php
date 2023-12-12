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

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <?php include "navbar.php"; ?>
            <?php include "sidebar_manager.php"; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Create New Purchase Request</h3>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form method="post" enctype="multipart/form-data" action="">
                                    <div class="row">
                                        <?php
                                        include "koneksi.php";

                                        // Mengambil data jumlah record pada tabel pr_po_list
                                        $queryCount = "SELECT COUNT(*) AS total FROM pr_po_list";
                                        $resultCount = mysqli_query($conn, $queryCount);
                                        $dataCount = mysqli_fetch_array($resultCount);
                                        $totalRecords = $dataCount['total'];

                                        // Menghitung urutan berikutnya
                                        $urutan = $totalRecords + 1;

                                        $huruf = "PR";
                                        $kd_kat = $huruf . "-" . sprintf("%04s", $urutan);
                                        ?>

                                        <div class="col-md-6">
                                            <label for="po_code" class="control-label text-danger">P.R. Code</label>
                                            <input type="text" id="po_code" name="po_code"
                                                class="form-control form-control-md rounded-1" value="<?php echo $kd_kat ?>"
                                                readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="supplier" class="control-label text-danger">Supplier</label>
                                                <select name="supplier" id="supplier" class="custom-select select2"
                                                    required>
                                                    <option value="">Pilih Supplier</option>
                                                    <?php
                                                    include "koneksi.php";

                                                    $query = mysqli_query($conn, "SELECT * FROM supplier_list") or die(mysqli_error($conn));
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        echo "<option value=$data[supplier_id]> $data[name] </option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="date_created" class="font-weight-bold">Date :</label>
                                            <input type="text" id="date_created" name="date_created" class="form-control"
                                                required min="<?php echo date('Y-m-01'); ?>"
                                                max="<?php echo date('Y-m-t'); ?>" autocomplete="off">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department" class="control-label text-danger">Department</label>
                                                <select name="department" id="department" class="custom-select select2"
                                                    required>
                                                    <option value="">Pilih Department</option>
                                                    <option value="General Admin">General Admin</option>
                                                    <option value="Front Office">Front Office</option>
                                                    <option value="Sales & Marketing">Sales & Marketing</option>
                                                    <option value="Human Resources">Human Resources</option>
                                                    <option value="Housekeeping">Housekeeping</option>
                                                    <option value="F&B Product">F&B Product</option>
                                                    <option value="F&B Service">F&B Service</option>
                                                    <option value="Engineering">Engineering</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <fieldset>
                                        <legend class="text-danger">Item Form</legend>
                                    </fieldset>
                                    <br>
                                    <table class="table table-striped table-bordered" id="list">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="10%">
                                            <col width="25%">
                                            <col width="15%">
                                            <col width="20%">
                                            <col width="25%">
                                        </colgroup>
                                        <thead>
                                            <tr class="text-light bg-gray">
                                                <th class="text-center py-1 px-2"></th>
                                                <th class="text-center py-1 px-2">Qty</th>
                                                <th class="text-center py-1 px-2">Item</th>
                                                <th class="text-center py-1 px-2">Unit</th>
                                                <th class="text-center py-1 px-2">Cost</th>
                                                <th class="text-center py-1 px-2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="pr-item">
                                                <td class="text-center">
                                                    <!-- <button class="btn btn-sm btn-danger " type="button"
                                                        onclick="rem_item(this)"><i class="fa fa-times"></i></button> -->
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" name="qty[]" class="form-control qty"
                                                        placeholder="Enter Quantity" min="0" required>
                                                </td>
                                                <td>
                                                    <select name="item[]" id="item" class="custom-select select2" required>
                                                        <option value="">Pilih Item</option>
                                                        <?php
                                                        include "koneksi.php";

                                                        $query = "SELECT item_id, name, unit, cost FROM item_list";

                                                        $result = mysqli_query($conn, $query);

                                                        if ($result) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['item_id'] . "' data-unit='" . $row['unit'] . "' data-cost='" . $row['cost'] . "'>" . $row['name'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "Gagal mengambil data supplier";
                                                        }

                                                        mysqli_close($conn);
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="unit[]" class="form-control unit">
                                                </td>
                                                <td class="text-right cost">
                                                    <input type="text" name="cost[]" class="form-control cost">
                                                </td>
                                                <td class="text-right total-price">
                                                    <input type="number" name="total_price[]"
                                                        class="form-control total-price" id="total_price" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-right py-1 px-2" colspan="5"><span><button
                                                            class="btn btn-sm btn-dark" type="button" id="add_row">Add
                                                            Row</button></span> Sub Total</th>
                                                <th class="text-right py-1 px-2 subtotal" id="sub_total"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-right py-1 px-2" colspan="5">Discount <input
                                                        style="width:40px !important" step="any" name="discount_perc"
                                                        class='' type="number" min="0" max="100"
                                                        value="<?php echo isset($discount_perc) ? $discount_perc : 0 ?>">%
                                                </th>
                                                <th class="text-right py-1 px-2 discount">
                                                    <input type="text" class="w-100 border-0 text-right" value="0"
                                                        name="discount_amount" readonly>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right py-1 px-2" colspan="5">Tax
                                                    <input style="width:40px !important" step="any" name="tax_perc" class=''
                                                        type="number" min="0" max="100"
                                                        value="<?php echo isset($tax_perc) ? $tax_perc : 0 ?>">%
                                                </th>
                                                <th class="text-right py-1 px-2 tax">
                                                    <input type="text" class="w-100 border-0 text-right" value="0"
                                                        name="tax_amount" readonly>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right py-1 px-2" colspan="5">Total </th>
                                                <th class="text-right py-1 px-2 tax">
                                                    <input type="text" name="total" class="w-100 border-0 text-right"
                                                        value="0" id="total" readonly>
                                                </th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="remarks" class="text-danger control-label">Remarks</label>
                                                <textarea name="remarks" id="remarks" rows="3"
                                                    class="form-control rounded-0"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row justify-content-center">
                                        <button class="btn btn-md btn-danger mr-2" type="submit" name="submit">Save</button>
                                        <a class="btn btn-md btn-secondary" href="purchase_request_manager.php">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        include "koneksi.php";
                        if (isset($_POST['submit'])) {
                            $po_code = $_POST['po_code'];
                            $supplier = $_POST['supplier'];
                            $datepicker = $_POST['date_created'];
                            $date_created = date('Y-m-d', strtotime($datepicker));
                            $department = $_POST['department'];
                            $qty = $_POST['qty'];
                            $item = $_POST['item'];
                            $unit = $_POST['unit'];
                            $cost = $_POST['cost'];
                            $total_price = str_replace('.', '', $_POST['total_price']);
                            $remarks = $_POST['remarks'];
                            $discount_perc = $_POST['discount_perc'];
                            $discount_amount = str_replace('.', '', $_POST['discount_amount']);
                            $tax_perc = $_POST['tax_perc'];
                            $tax_amount = str_replace('.', '', $_POST['tax_amount']);
                            $total = str_replace('.', '', $_POST['total']);

                            $query = "INSERT INTO pr_po_list (po_code, supplier, date_created, department, remarks, discount_perc, discount_amount, tax_perc, tax_amount, total) VALUES ('$po_code', '$supplier', '$date_created', '$department', '$remarks', '$discount_perc', '$discount_amount', '$tax_perc', '$tax_amount', '$total')";
                            // get id from $query insert
                            $result = mysqli_query($conn, $query);
                            $last_id = mysqli_insert_id($conn);


                            for ($i = 0; $i < count($qty); $i++) {
                                $itemDetailQuery = "INSERT INTO item_detail (id_po, qty, item, unit, cost, total_price) VALUES ($last_id, '$qty[$i]', '$item[$i]', '$unit[$i]', '$cost[$i]', '$total_price[$i]')";
                                $result = mysqli_query($conn, $itemDetailQuery);

                                if ($result) {
                                    // Menampilkan SweetAlert setelah berhasil ditambahkan
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Inserted!',
                                            text: 'The Purchase Request Successfully Saved.',
                                            icon: 'success'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'purchase_request_manager.php';
                                            }
                                        });
                                    </script>";
                                } else {
                                    // Menampilkan SweetAlert jika terjadi error
                                    echo "<script>
                                            swal({
                                                title: 'Error!',
                                                text: 'Gagal menambahkan data.',
                                                icon: 'error',
                                            });
                                        </script>";
                                }
                            }
                            $conn->close();
                        } else {
                            echo " " . mysqli_error($conn);
                        }


                        ?>
                    </div>
                </section>
            </div>

            <?php include "footer.php"; ?>
        </div>
        <table class="d-none" id="item-clone">
            <tr class="pr-item">
                <td class="text-center">
                    <button class="btn btn-sm btn-danger " type="button" onclick="rem_item($(this))"><i
                            class="fa fa-times"></i></button>
                </td>
                <td class="text-center">
                    <input type="number" name="qty[]" class="form-control" id="qty" placeholder="Enter Quantity" min="0">
                </td>
                <td>
                    <select name="item[]" id="item" class="custom-select select2">
                        <option value="">Pilih Item</option>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "neo");

                        if (mysqli_connect_errno()) {
                            echo "Koneksi database gagal: " . mysqli_connect_error();
                        }

                        $query = "SELECT item_id, name, unit, cost FROM item_list";

                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['item_id'] . "' data-unit='" . $row['unit'] . "' data-cost='" . $row['cost'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "Gagal mengambil data supplier";
                        }

                        mysqli_close($conn);
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="unit[]" class="form-control" id="unit">
                    </t[]d>
                <td class="text-right cost">
                    <input type="text" name="cost[]" class="form-control" id="cost">
                </td>
                <td class="text-right total">
                    <input type="number" name="total" class="form-control total-price" id="total" readonly>
                </td>
            </tr>
        </table>

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" /> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script> -->
        <script src="admin/plugins/select2/js/select2.min.js"></script>
        <script src="admin/dist/js/select2.min.js"></script>
        <!-- Select2 -->
        <script src="../../plugins/select2/js/select2.full.min.js"></script>
        <!-- datepicker -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
        <script src="./plugins/sweet-alert/sweetalert.js"></script>

        <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
        <script src="./plugins/jquery-ui-1/jquery-ui-1.js"></script>
        <!--<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

        <!-- <script>$(document).ready(function () {
                $('#department').select2();
                $('#supplier').select2();
            });
        </script> -->


        <script>
            $(document).ready(function () {
                $("#date_created").datepicker();
                // Function to format a number as "000.000.000"
                function formatNumber(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(number);
                }

                // Function to update total price and subtotal
                function updateRowTotal(row) {
                    var qty = parseFloat(row.find('input.qty').val()) || 0;
                    var cost = parseFloat(row.find('input[name="cost[]"]').val()) || 0;
                    var total = qty * cost;
                    row.find('input[name="total_price[]"]').val(formatNumber(total));
                }

                // Function to calculate subtotal
                function calculateSubtotal() {
                    var subtotal = 0;
                    $('#list tbody .pr-item').each(function () {
                        var total = parseFloat($(this).find('input[name="total_price[]"]').val().replace(/\./g, '').replace(',', '.')) || 0;
                        subtotal += total;
                    });
                    $('#sub_total').text(formatNumber(subtotal));
                    updateDiscountAndTax();
                }

                // Function to update discount and tax
                function updateDiscountAndTax() {
                    var discountPercentage = parseFloat($('input[name="discount_perc"]').val()) || 0;
                    var taxPercentage = parseFloat($('input[name="tax_perc"]').val()) || 0;
                    var subtotal = parseFloat($('#sub_total').text().replace(/\./g, '').replace(',', '.')) || 0;

                    var discountAmount = (subtotal * discountPercentage) / 100;
                    var taxAmount = (subtotal * taxPercentage) / 100;

                    $('input[name="discount_amount"]').val(formatNumber(discountAmount));
                    $('input[name="tax_amount"]').val(formatNumber(taxAmount));
                    calculateTotal();
                }

                // Function to calculate total
                function calculateTotal() {
                    var subtotal = parseFloat($('#sub_total').text().replace(/\./g, '').replace(',', '.')) || 0;
                    var discountAmount = parseFloat($('input[name="discount_amount"]').val().replace(/\./g, '').replace(',', '.')) || 0;
                    var taxAmount = parseFloat($('input[name="tax_amount"]').val().replace(/\./g, '').replace(',', '.')) || 0;

                    var total = subtotal - discountAmount + taxAmount;
                    $('input[name="total"]').val(formatNumber(total));
                }

                // Event handlers
                $('#list tbody').on('change', 'select[name="item[]"]', function () {
                    var row = $(this).closest('tr');
                    var selectedOption = $(this).find('option:selected');
                    var unit = selectedOption.data('unit');
                    var cost = selectedOption.data('cost');
                    row.find('input[name="unit[]"]').val(unit);
                    row.find('input[name="cost[]"]').val(cost);
                    updateRowTotal(row);
                    calculateSubtotal();
                });

                $('#list tbody').on('input', 'input[name="qty"], input[name="cost"]', function () {
                    var row = $(this).closest('tr');
                    updateRowTotal(row);
                    calculateSubtotal();
                });

                $('#add_row').on('click', function () {
                    var clone = $('#list tbody .pr-item:first').clone();
                    clone.find('td:first').html('<button class="btn btn-sm btn-danger remove_item" type="button"><i class="fa fa-times"></i></button>');
                    clone.find('input').val(''); // Clear input values in the cloned row
                    $('#list tbody').append(clone);
                });

                $('input[name="discount_perc"], input[name="tax_perc"]').on('input', function () {
                    updateDiscountAndTax();
                });

                $('input[name="discount_amount"], input[name="tax_amount"]').on('input', function () {
                    calculateTotal();
                });

                // Initial calculations
                calculateSubtotal();


                $(document).on('click', '.remove_item', function () {
                    $(this).closest('tr').remove();
                    calculateSubtotal();
                });
            });

        </script>
    </body>

    </html>

    <?php
}
?>