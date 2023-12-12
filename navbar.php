<nav
    class="main-header navbar navbar-expand navbar-dark border border-light border-top-0  border-left-0 border-right-0 navbar-light text-sm bg-red">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <?php
        include "koneksi.php";

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $sql = "SELECT type FROM user_list WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row['type'] == 'Admin') {
                $navbarText = "Purchasing & Receiving System - Admin";
            } elseif ($row['type'] == 'Manager') {
                $navbarText = "Purchasing & Receiving System - Manager";
            } else {
                $navbarText = "Purchasing & Receiving System";
            }
        }
        ?>

        <li class="navbar-nav">
            <a class="nav-link">
                <?php echo $navbarText; ?>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a type="button" class="btn btn-sm btn-dark" href="logout.php">Logout</a>
        </li>
    </ul>
</nav>