<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <a href="" class="brand-link bg-red text-sm">
        <img src="assets/logo.png" class="brand-image img-circle elevation-3" style="width: 30px; height: 30px;">
        <span>
            <?php echo $_SESSION['username']; ?>
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="home_admin.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="purchase_request.php" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Purchase Request
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="purchase_order.php" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Purchase Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="receiving.php" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Receiving
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="report.php" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Receiving Reports
                        </p>
                    </a>
                </li>
                <li class="nav-header">Maintenance</li>
                <li class="nav-item dropdown">
                    <a href="list_supplier.php" class="nav-link nav-maintenance_supplier">
                        <i class="nav-icon fas fa-truck-loading"></i>
                        <p>
                            Supplier List
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="list_item.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Item List
                        </p>
                    </a>
                </li>
                <?php
                include "koneksi.php";

                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $sql = "SELECT type FROM user_list WHERE username='$username'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if ($row['type'] == 'Super Admin') {
                        ?>
                        <li class="nav-item dropdown">
                            <a href="list_user.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    User List
                                </p>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </nav>
    </div>
</aside>