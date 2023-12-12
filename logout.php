<?php
session_start();
echo "<script src='./plugins/sweet-alert/sweetalert.js'></script>";

if (isset($_SESSION['username'])) {
    session_destroy();
    echo "<script>
    setTimeout(function(){
        Swal.fire({
            title: 'Success Logout!',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
    }, 100);
</script>";
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>