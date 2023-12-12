<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "SELECT po.*, s.supplier_id, s.name AS supplier_name, s.address, s.contact
    FROM pr_po_list po
    INNER JOIN supplier_list s ON po.supplier = s.supplier_id
    WHERE po.id = '$id'";

  $result = mysqli_query($conn, $query);

  if($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    $query_items = "SELECT d.*, i.name AS item FROM item_detail d INNER JOIN item_list i ON d.item = i.item_id WHERE d.id_po = '$id'";
    $result_items = mysqli_query($conn, $query_items);

    $subtotal = 0;

    $deliveryDate = date('Y-m-d', strtotime($data['date_created'].' +2 weekdays'));
    if(date('w', strtotime($deliveryDate)) == 0) {
      $deliveryDate = date('Y-m-d', strtotime($deliveryDate.' +1 day'));
    }

    echo "<html>";
    echo "<head>";
    echo "<title>Receiving Order Details</title>";
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
    echo "<img src='assets/neo.png' style='height: 40px; width: 60px; margin-top: 0px; margin-left: 10px; margin-bottom: 10px;'><br>";
    echo "</div>";
    echo "<div class='header-center'>";
    echo "<h3 style='font-family: Quicksand, sans-serif; margin-top: 0px; margin-left: -220px;'><b> Hotel NEO+ Green Savana </b></h3>";
    echo "</div>";
    echo "<div class='header-right'>";
    echo "<p style='font-size: 16px; margin-top: -10px;'><b>Receiving Order</b></p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='header-container'>";
    echo "<div class='header-left'>";
    echo "<p style='font-size: 12px;'><b>From</b><br> Komplex Taman Budaya Jl. Siliwangi No.1<br>  Sentul City Bogor 16810, Indonesia<br>Email : Sentulinfo@NeoHotels.com <br> Phone: +62-21 - 2921 0831</p>";
    echo "</div>";
    echo "<div class='header-center'>";
    echo "<p style='font-size: 12px;'><b>To</b><br> {$data['supplier_name']}<br> {$data['address']}<br>Phone : {$data['contact']}</p>";
    echo "</div>";
    echo "<div class='header-left'>";
    echo "<p style='font-size: 12px;'><b>PO-Code : {$data['po_code']}</b><br><br> <b>Date of Order : {$data['date_created']}</b><br> <b>Payment Due :</b> 30 Days<br> <b>Delivery Date :</b> {$deliveryDate}</p>";
    echo "</div>";
    echo "</div>";

    echo "<hr>";
    echo "<table class='table table-striped table-bordered' id='example1'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Quantity</th>";
    echo "<th>Name of Item</th>";
    echo "<th>Unit</th>";
    echo "<th>Cost</th>";
    echo "<th>Total</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($item = mysqli_fetch_assoc($result_items)) {
      $subtotal += $item['total_price'];
      echo "<tr>";
      echo "<td>{$item['qty']}</td>";
      echo "<td>{$item['item']}</td>";
      echo "<td>{$item['unit']}</td>";
      echo "<td>".number_format($item['cost'], 0, '.', '.')."</td>";
      echo "<td>".number_format($item['total_price'], 0, '.', '.')."</td>";
      echo "</tr>";
      echo "</tbody>";
    }
    echo "</table>";

    echo "<hr>";
    echo "<table class='table table-striped table-bordered' id='example1'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='width: 50%'>Remarks</th>";
    echo "<th style='text-align: right; width: 50%;'>Subtotal :</th>";
    echo "<td style='text-align: right;'>".number_format($subtotal, 0, '.', '.')."</td>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>{$data['remarks']}</td>";
    echo "<th style='text-align: right;'>Discount ({$data['discount_perc']}%) :</th>";
    echo "<td style='text-align: right;'>".number_format($data['discount_amount'], 0, '.', '.')."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<th style='text-align: right;'>Tax ({$data['tax_perc']}%) :</th>";
    echo "<td style='text-align: right;'>".number_format($data['tax_amount'], 0, '.', '.')."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<th style='text-align: right;'>Total :</th>";
    echo "<td style='text-align: right;'>".number_format($data['total'], 0, '.', '.')."</td>";
    echo "</tr>";
    echo "</tbody>";
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
  echo "Invalid request";
}
?>