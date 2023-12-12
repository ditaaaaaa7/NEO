<?php
include 'koneksi.php';

if(isset($_GET['supplier'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
    $supplier = $_GET['supplier'];

    $query = "SELECT pr.*, sl.name AS supplier_name FROM pr_po_list pr
              JOIN supplier_list sl ON pr.supplier = sl.supplier_id
              WHERE MONTH(pr.date_created) = $month AND YEAR(pr.date_created) = $year AND pr.supplier = $supplier AND pr.status = 'Receive'";
    $result = mysqli_query($conn, $query);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $subtotal = 0;

            echo "<html>";
            echo "<head>";
            echo "<title>Purchase Order Details</title>";
            echo "<link rel='icon' href='assets/logo.png' type='image/x-icon'>";
            echo "<link rel='stylesheet' href='dist/css/style.css'>";
            echo "<link rel='stylesheet' href='bower_components/bootstrap/dist/css/bootstrap.min.css'>";
            echo "<link rel='stylesheet' href='bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'>";
            echo "<style>
            .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
        
            .header-left {
                display: flex;
                align-items: center;
            }
        
            .header-left img {
                height: 90px;
                width: 100px;
                margin-right: 10px;
            }
        
            .header-right {
                text-align: right;
            }
        
            .header-right h3 {
                font-family: 'Quicksand', sans-serif;
                margin-top: -30px;
            }
        
            .header-right p {
                font-size: 12px;
            }
        
            .header-right small {
                float: right;
            }
            </style>";
            echo "</head>";
            echo "<body onload='window.print()' style='font-family: Quicksand, sans-serif'>";
            echo "<div class='header-container'>";
            echo "<div class='header-left'>";
            echo "<img src='assets/neo.png' style='height: 80px; width: 100px; margin-top: 0px; margin-left: 50px; margin-bottom: -10px;'><br>";
            echo "</div>";
            echo "<div class='header-center'>";
            echo "<h3 style='font-family: Quicksand, sans-serif; margin-right: 100px;' class='text-center'><b> Hotel NEO+ Green Savana </b></h3>";
            echo "<p style='font-size: 12px; margin-right: 100px;' class='text-center'>Komplex Taman Budaya Jl. Siliwangi No.1 Sentul City Bogor 16810, Indonesia<br>Email : Sentulinfo@NeoHotels.com | Phone: +62-21 - 2921 0831</p>";
            echo "</div>";
            echo "</div>";
            echo "<div class='header-container'>";
            echo "<div class='header-left'>";
            echo "<p style='font-size: 16px;'><b>Report of Receiving Orders</b></p>";
            echo "</div>";
            echo "</div>";

            echo "<hr>";
            echo "<table class='table table-striped table-bordered' id='example1'>";
            echo "<thead><tr><th>No.</th><th>Date Created</th><th>P.O. Code</th><th>Supplier</th><th>Total</th></tr></thead>";
            echo "<tbody>";
            $no = 1;

            while($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>{$data['date_created']}</td>";
                echo "<td>{$data['po_code']}</td>";
                echo "<td>{$data['supplier_name']}</td>";  // Gunakan supplier_name dari hasil gabungan tabel
                echo "<td>".number_format($data['total'], 0, '.', '.')."</td>";
                echo "</tr>";
                $subtotal += $data['total'];
                $no++;
            }
            echo "</tbody>";
            echo "</table>";

            echo "<hr>";
            echo "<table class='table table-striped table-bordered' id='example1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th style='text-align: right; width: 83%;'>Total :</th>";
            echo "<td style='text-align: left;'>".number_format($subtotal, 0, '.', '.')."</td>";
            echo "</tr>";
            echo "</thead>";
            echo "</table><br><br><br>";

            echo "<div class='header-container'>";
            echo "<div class='header-center'>";
            echo "<p style='font-size: 16px; margin-left: 100px;'><b>Purchasing</b></p>";
            echo "</div>";
            echo "<div class='header-center'>";
            echo "<p style='font-size: 16px; margin-left: -280px;'><b>Chief Accounting</b></p>";
            echo "</div>";
            echo "</div><br><br><br><br>";

            echo "<div class='header-container'>";
            echo "<div class='header-center'>";
            echo "<p style='font-size: 16px; margin-left: 80px;'>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>";
            echo "</div>";
            echo "<div class='header-center'>";
            echo "<p style='font-size: 16px; margin-left: -280px;'>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>";
            echo "</div>";
            echo "</div>";

            echo "<script src='bower_components/jquery/dist/jquery.min.js'></script>";
            echo "<script src='bower_components/bootstrap/dist/js/bootstrap.min.js'></script>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "Data not found";
        }
    } else {
        echo "Query error: ".mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
?>