<nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-secondary">
            <i class="fas fa-align-left"></i>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-user mr-1"></i>Admin
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" data-toggle="modal" data-target="#Profile"><i class="fas fa-user mr-2"></i>Profile</a>
                            <a href="logout.php" class="dropdown-item"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

 <!-- Sidebar  -->
 <nav id="sidebar">
    <div class="sidebar-header">
        <img style="border-radius: 50%;" src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/restaurant-logo-template-design-deaa426a55e5dc6d4604fe46f2bb543a_screen.jpg?ts=1566606296" width="40" height="40" alt="logo"> <span class="ml-2">E-Commerce</span>
    </div>

    <ul class="list-unstyled components">
        <center>
            <img style="border-radius: 50%;" src="<?php echo isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male' ? 'https://png.pngtree.com/png-vector/20190321/ourmid/pngtree-vector-users-icon-png-image_856952.jpg' : 'https://t4.ftcdn.net/jpg/01/24/46/81/500_F_124468197_bTywsXbEFgpuO7OmN8UrjgpyaKckqg7H.jpg';?>" width="95" height="90" alt="avatar">
            <p><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '';?><br>Admin</p>
        </center>
        <li>
            <a href="admin.php"><i class="fas fa-home mr-2"></i>Home</a>
        </li>
        <li>
            <a href="parcelClient.php"><i class="fas fa-chart-pie mr-2"></i>Order List</a>
        </li>
        <li>
            <a href="foodCategory.php"><i class="fas fa-clipboard-list mr-2"></i>Category</a>
        </li>
        <li>
            <a href="foodMenu.php"><i class="fas fa-list mr-2"></i>Products</a>
        </li>
        <li>
            <a href="review.php"><i class="fas fa-comment mr-2"></i>Reviews</a>
        </li>
    </ul>
</nav>

<?php  include('Modal/profile_modal.php'); ?>