<?php
include 'koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pr_id = $_GET['id'];

    // Query untuk mengubah status PR menjadi "Approve" (gantilah 'status_column' dengan kolom yang sesuai di tabel Anda)
    $updateStatusQuery = "UPDATE pr_po_list SET status = 'Process' WHERE id = $pr_id";

    // Eksekusi query
    if (mysqli_query($conn, $updateStatusQuery)) {
        // Jika status berhasil diubah, ubah juga PR Code
        $updatePRCodeQuery = "UPDATE pr_po_list SET po_code = REPLACE(po_code, 'PR-', 'PO-') WHERE id = $pr_id";

        // Eksekusi query
        if (mysqli_query($conn, $updatePRCodeQuery)) {
            ?>
            <script type="text/javascript">
                alert("Purchase order successfully approved.");
                window.location.href = "purchase_order.php";
            </script>
            <?php
        } else {
            echo "Error updating PR Code: " . mysqli_error($conn);
        }
    } else {
        echo "Error approve purchase request: " . mysqli_error($conn);
    }
}
?>