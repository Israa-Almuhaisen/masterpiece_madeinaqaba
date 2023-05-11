<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark" style="height: 100%;">
                <a href="http://localhost/finalMasterPiece/admin/admin.php" class="navbar-brand mx-4 mb-3">
                    <img src="../images/adminimage.png" style="border-radius: 20%;" width="150px" height="150px" alt="0">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h4 class="mb-0">

                        <?php $select_accounts = $conn->prepare("SELECT * FROM `admins` WHERE id = '$admin_id'");
                                $select_accounts->execute();
                                $admin_name = $select_accounts->fetch();
                                echo strtoupper($admin_name['name']);
                        ?>
                        </h4>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="products.php" class="nav-item nav-link "><i class="fa fa-th me-2"></i>Products</a>
                    <!-- <a href="sold.php" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-store-slash me-2"></i>Sold</a> -->
                    <a href="sales.php" class="nav-item nav-link"><i class="fa-brands fa-adversal me-2"></i>Sales</a>
                    <a href="category.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Category</a>
                    <a href="orders.php" class="nav-item nav-link"><i class="fa-solid fa-truck me-2"></i>Orders</a>
                    <a href="admin.php" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-tie me-2"></i>Admins</a>
                    <a href="users.php" class="nav-item nav-link"><i class="fa-solid fa-user me-2"></i>Users</a>
                    <a href="../components/admin_logout.php" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                </div>
            </nav>
        </div>