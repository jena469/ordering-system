<?php require('route.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include('header.php');?>
    <title>Print Parcel Clients | Page</title>
</head>
<body>
    <div class="wrapper">
        <div id="content">
            <div class="card">
                <div class="card-header">
                    View Parcel Clients
                </div>
                <div class="card-body">
                   <?php viewParcelClients(isset($_GET['userId']) ? $_GET['userId'] : '');?>
                </div>
            </div>

            <div class="line"></div>
        </div>
    </div>

    <?php include('footer.php');?>
</body>
</html>