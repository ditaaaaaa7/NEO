<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    include "koneksi.php";

    $id = $_GET['id'];

    $query = "DELETE FROM supplier_list WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("Supplier Delete Success");
            window.location.href = "list_supplier.php";
        </script>
        <?php
    } else {
        echo "Fail to Delete Supplier";
    }
} else {
    header("Location: list_supplier.php");
    exit;
}
?>