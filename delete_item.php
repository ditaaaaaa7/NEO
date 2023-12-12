<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    include "koneksi.php";

    $id = $_GET['id'];

    $query = "DELETE FROM item_list WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("Item Delete Success");
            window.location.href = "list_item.php";
        </script>
        <?php
    } else {
        echo "Fail to Delete Item";
    }
} else {
    header("Location: list_item.php");
    exit;
}
?>