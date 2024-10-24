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
    <title>Order List | Page</title>
</head>
<body>
    <div class="wrapper">
        <div id="content">
            <?php include('sidebar.php');?>

            <div class="card">
                <div class="card-header">
                    Order List
                </div>
                <div class="card-footer search-bar">
                <div class="input-group">
                    <input type="text" id="search_order" class="form-control search-input" placeholder="Search orders...">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table  class="table table-bordered text-center" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>User Id</th>
                                    <th>Customer Name</th>
                                    <!-- <th>Email</th> -->
                                    <th>Order Dates</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="products_table">
                                <?php getParcelClients();?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div class="line"></div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
            $("#search_order").keyup(function () {
                var value = $(this).val().toLowerCase(); // Updated selector to use $(this)
                $("#products_table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        });
    </script>
    <?php include('footer.php');?>
</body>
</html>