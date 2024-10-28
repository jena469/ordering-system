<?php
require('route.php');

if (
    !isset($_SESSION['admin']) && $_SESSION['admin'] !== ''
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
    <?php include('header.php'); ?>
    <title>Review | Page</title>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php include('sidebar.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4 class="mt-2">Review List</h4>
                </div>
                <div class="card-body">
                    <div style="overflow-x: hidden ;">
                        <table id="dataTables" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Review Id</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Product Quality</th>
                                    <th>Seller Service</th>
                                    <th>Delivery Speed</th>
                                    <th>Message</th>
                                    <th>Review Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getReview(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="line"></div>
        </div>
    </div>

    <script>
        const removeReview = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to remove!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Remove'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'route.php?removeReview=' + id;
                }
            })
        }
    </script>

    <?php include('footer.php'); ?>
</body>

</html>