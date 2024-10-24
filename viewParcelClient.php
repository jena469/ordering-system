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
    <?php include('navbar.php'); 
    ?>

    <div class="container mb-5">
        <div class="card">
            <div class="card-header">
                View Parcel Clients
            </div>
            <div class="card-body">
                 
                <?php 
               
               $userId = isset($_GET['userId']) ? htmlspecialchars($_GET['userId']) : 'Not provided';
               $checkoutId = isset($_GET['checkoutId']) ? htmlspecialchars($_GET['checkoutId']) : 'Not provided';

              
               // Call the function with both parameters
               viewParcelClientsUser($userId, $checkoutId);
                ?>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>