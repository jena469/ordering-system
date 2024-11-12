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
    <title>Food Menu | Page</title>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php include('sidebar.php');?>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="mt-2">Product List</h4>
                        </div>
                        <div class="col">
                            <button style="float: right;" class="btn btn-primary" data-toggle="modal"
                                data-target="#addFoodMenu" onclick="prepareAddProd()"> <i class="fas fa-plus"></i> Add
                                Product</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table id="dataTables" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Menu Id</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stocks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getFoodMenu();?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="line"></div>
        </div>
    </div>

    <script>
    const removeFoodMenu = (id) => {
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
                window.location = 'route.php?removeFoodMenu=' + id;
            }
        })
    }

    function prepareAddProd() {
        $('#prod_form').attr('action', 'route.php');
        $('#addFoodMenuLabel').text('Add Category');
        $('#menu_id').val('');
        $('#cat_id').val('');
        $('#title').val('');
        $('#desc').val('');
        $('#price').val('');
        $('#stocks').val('');
        $('#pic').attr('required', 'required');
        $("#submit_btn").attr("name", "AddFood");

    }

    function prepareUpdateProd(menu_id, pic, cat_id, title, description, price, stocks) {
        $('#prod_form').attr('action', 'route.php');
        $('#addFoodMenuLabel').text('Add Category');
        $('#menu_id').val(menu_id);
        // $('#pic').val(pic);
        $('#cat_id').val(cat_id);
        $('#title').val(title);
        $('#desc').val(description);
        $('#price').val(price);
        $('#stocks').val(stocks);
        $('#pic').removeAttr('required');
        // $('#pic-info').text(pic ? `Current file: ${pic}` : 'No file selected');    
        $("#submit_btn").attr("name", "UpdateFood");
        $('#addFoodMenu').modal('show');

    }
    </script>

    <?php include('Modal/addFoodMenu_modal.php'); include('footer.php');?>
</body>

</html>