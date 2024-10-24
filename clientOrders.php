<?php include('route.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php'); ?>
    <title>View Orders | Page</title>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mb-5">
        <table id="dataTables" class="table table-bordered text-center" style="width: 100%;">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <!-- <th>Email</th> -->
                    <th>Order Date</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>View Order</th>
                </tr>
            </thead>
            <tbody>
                <?php viewClientOrders(); ?>
            </tbody>
        </table>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>