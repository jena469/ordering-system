<style>
.navbar {
    background-color: #343a40;
}

.navbar-brand img {
    border-radius: 50%;
}

.navbar-nav .nav-link {
    color: #f8f9fa;
    font-weight: 500;
}

.navbar-nav .nav-link:hover {
    color: #ffc107;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2Utb3BhY2l0eT0iMCIvPjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2Utb3BhY2l0eT0iMCIvPjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2Utb3BhY2l0eT0iMCIvPjwvc3ZnPg==");
}

.btn-custom {
    background-color: #ffc107;
    color: #343a40;
}

.btn-custom:hover {
    background-color: #e0a800;
    color: #343a40;
}

.badge-danger {
    background-color: #dc3545;
}

.welcome-customer {
    background-color: transparent;
    color: #343a40;
    padding: 10px;
    border-radius: 0 0 0.25rem 0.25rem;
    text-align: center;
    font-size: 1.2rem;
    margin-top: -1px;
}
</style>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">
        <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/restaurant-logo-template-design-deaa426a55e5dc6d4604fe46f2bb543a_screen.jpg?ts=1566606296"
            width="40" height="40" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-home mr-2"></i>Home</a>
            </li>
            <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item ">
                <a class="nav-link text-warning" href="clientOrders.php"><i
                        class="fas fa-shopping-cart mr-2 text-warning"></i>View Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="logoutCustomer.php"><i
                        class="fas fa-power-off mr-2 text-danger"></i>Logout</a>
            </li>
            <?php endif; ?>
        </ul>

        <div class="form-inline my-2 my-lg-0">
            <?php if (!isset($_SESSION['user'])): ?>
            <a href="login.php" class="btn btn-custom my-2 my-sm-0"><i class="fa fa-user mr-2"></i>Login</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
            <a href="ListItemCart.php" class="btn btn-outline-light my-2 my-sm-0">
                <i class="fas fa-shopping-cart mr-2"></i>Cart
                <span
                    class="badge badge-danger ml-2"><?php echo isset($_SESSION['addedOrder']) ? count($_SESSION['addedOrder']) : ''; ?></span>
            </a>

            <!-- Cart Button -->

            <?php endif; ?>
        </div>
        <div class="form-inline my-2 my-lg-0 mx-2">
            <?php if (isset($_SESSION['user'])): ?>
            <!-- Notification Dropdown -->
            <div class="d-flex justify-content-between">
                <div class="dropdown mr-2">
                    <button class="btn btn-outline-light" type="button" id="notificationDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-danger ml-2"><?php getNotifications(); ?> </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                        <?php getNotificationContent(); ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Welcome Message -->
<?php if (isset($_SESSION['user'])): ?>
<div class="welcome-customer">
    <?php $name = ucwords(strtolower($_SESSION['customerName'])) ?>

    Welcome, <b><?php echo isset($_SESSION['customerName']) ?  $name : 'Customer' ?></b>
</div>
<?php endif; ?>
<script>
function updateNotif(ckid, regId) {
    // Perform an AJAX request to update the notification
    fetch('route.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'checkout_id=' + encodeURIComponent(ckid)
        })
        .then(response => response.text())
        .then(data => {

            // window.location.href = "viewParcelClient.php?userId=" + encodeURIComponent(regId) + "&checkoutId=" + encodeURIComponent(ckid);
        })
        .catch(error => console.error('Error:', error));
}
</script>