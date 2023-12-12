<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    include "koneksi.php";

    $id = $_GET['id'];

    // Pastikan data yang akan dihapus memiliki status "pending"
    $query = "DELETE FROM pr_po_list WHERE id = $id AND status = 'pending'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("Purchase Request Delete Success");
            window.location.href = "purchase_request.php";
        </script>
        <?php
    } else {
        echo "Fail to Delete Purchase Request";
    }
} else {
    header("Location: purchase_request.php");
    exit;
}
?>