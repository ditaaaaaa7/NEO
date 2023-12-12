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
                    <a href="home_manager.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="purchase_request_manager.php" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Purchase Request
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="purchase_order_manager.php" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Purchase Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="receiving_manager.php" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Receiving
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="report_manager.php" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Receiving Reports
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>