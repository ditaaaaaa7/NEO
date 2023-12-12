<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    include "koneksi.php";

    $id = $_GET['id'];

    $query = "DELETE FROM user_list WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("User Delete Success");
            window.location.href = "list_user.php";
        </script>
        <?php
    } else {
        echo "Fail to Delete User";
    }
} else {
    header("Location: list_user.php");
    exit;
}
?>