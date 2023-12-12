<?php
include 'koneksi.php';

// Ambil nilai filter dari permintaan POST
$selectedMonth = $_POST['month'];
$selectedYear = $_POST['year'];
$selectedSupplier = $_POST['supplier'];

// Cek apakah bulan, tahun, dan supplier dipilih
if (!empty($selectedMonth) && !empty($selectedYear) && !empty($selectedSupplier)) {
    // Bangun kueri SQL sesuai dengan nilai filter
    $query = "SELECT pr_po_list.*, supplier_list.name 
              FROM pr_po_list 
              JOIN supplier_list ON pr_po_list.supplier = supplier_list.supplier_id
              WHERE pr_po_list.status = 'Receive'
              AND MONTH(pr_po_list.date_created) = ?
              AND YEAR(pr_po_list.date_created) = ?
              AND pr_po_list.supplier = ?
              ORDER BY pr_po_list.po_code DESC";

    // Persiapkan pernyataan kueri
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "iii", $selectedMonth, $selectedYear, $selectedSupplier);

    // Eksekusi pernyataan kueri
    mysqli_stmt_execute($stmt);

    // Dapatkan hasil kueri
    $result = mysqli_stmt_get_result($stmt);

    // Tampilkan data sesuai dengan format HTML
    $no = 1;
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . $row['date_created'] . "</td>";
        echo "<td>" . $row['po_code'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . number_format($row['total'], 0, '.', '.') . "</td>";
        echo "</tr>";
        $no++;
    }

    // Tutup pernyataan kueri
    mysqli_stmt_close($stmt);
} else {
    echo "Please select Month, Year, and Supplier";
}

// Tutup koneksi
mysqli_close($conn);
?>