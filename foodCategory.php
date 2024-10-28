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
    <title>Food Category | Page</title>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php include('sidebar.php');?>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="mt-2">Food Category</h4>
                        </div>
                        <div class="col">
                            <button style="float: right;" class="btn btn-primary" data-toggle="modal"
                                data-target="#addCategory" onclick="prepareAdd()"> <i class="fas fa-plus"></i> New
                                Category</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;">
                        <table id="dataTables" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Category Id</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getFoodCategory();?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="line"></div>
        </div>
    </div>

    <script>
    const removeFoodCategory = (id) => {
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
                window.location = 'route.php?removeFoodCategory=' + id;
            }
        })
    }
    </script>

    <script>
    function prepareAdd() {
        $('#category_form').attr('action', 'route.php');
        $('#addCategoryLabel').text('Add Category');
        $('#cat_id').val('');
        $('#category').val('');
        $("#submit_btn").attr("name", "AddFoodCategory");

    }

    function prepareUpdate(cat_id, title) {
        $('#addCategory').attr('action', 'route.php');
        $('#addCategoryLabel').text('Updat Category');
        $('#cat_id').val(cat_id);
        $('#category').val(title);
        $("#submit_btn").attr("name", "UpdateFoodCategory");
        $('#addCategory').modal('show');

    }
    </script>

    <?php include('Modal/addCategory_modal.php'); include('footer.php');?>
</body>

</html>