<?php
include 'koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $po_id = $_GET['id'];

    // Query untuk mengubah status PO menjadi "Receive"
    $updateStatusQuery = "UPDATE pr_po_list SET status = 'Receive' WHERE id = $po_id";

    // Eksekusi query
    if (mysqli_query($conn, $updateStatusQuery)) {
        ?>
        <script type="text/javascript">
            alert("Purchase Order Successfully Received.");
            window.location.href = "receiving.php";
        </script>
        <?php
    } else {
        echo "Failed Purchase Order for Received!" . mysqli_error($conn);
    }
}
?>