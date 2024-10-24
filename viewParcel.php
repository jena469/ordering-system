<?php
    require('route.php');

    if(!isset($_SESSION['admin']) && $_SESSION['admin'] !== ''
    ) {
        echo '<script>window.location="loginAdmin.php"</script>';
        die();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include('header.php');?>
    <title>View Parcel Clients | Page</title>
</head>
<body>
    <div class="wrapper">
        <div id="content">
            <?php include('sidebar.php');?>

            <div class="card">
                <div class="card-header">
                    View Parcel Clients
                </div>
                <div class="card-body">
                   <?php 
               
               $userId = isset($_GET['userId']) ? htmlspecialchars($_GET['userId']) : 'Not provided';
               $checkoutId = isset($_GET['checkoutId']) ? htmlspecialchars($_GET['checkoutId']) : 'Not provided';

              
               // Call the function with both parameters
               viewParcelClients($userId, $checkoutId);
               ?>
                </div>
            </div>

            <div class="line"></div>
        </div>
    </div>
    <script>
        

        function addDelivery(ckid) {
            // alert(ckid);
            $('#checkout_id').val(ckid );
            $('#addDeliveryProof').modal('show');

        }

    </script>

    <?php include('Modal/deliveryProof_modal.php');
     include('footer.php');?>
</body>
</html>