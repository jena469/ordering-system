<?php include('route.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php'); ?>
    <title>View Add Cart | Page</title>
    <style>
        button.swal2-confirm.btn.btn-success {
            margin: 13px;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mb-5">
        <div class="card">
            <div class="card-header">
                View Add Cart
            </div>
            <div class="card-body">
                <table class='table table-bordered'>
                    <tr>
                        <th>Images</th>
                        <th>Food Title</th>
                        <th>Food Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $showTotalQty = 0;
                    $alltotal = 0;


                    foreach (isset($_SESSION['addedOrder']) ? $_SESSION['addedOrder'] : [] as $resultAddedCart) {
                        $showTotalQty += $resultAddedCart['qty'];

                        getPreviewCartCategory(
                            $resultAddedCart['menuId'],
                            $resultAddedCart['qty']
                        );
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th>Total Quantity</th>
                            <td colspan="6">
                                <b class="text-danger"><?php echo $showTotalQty; ?></b>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td colspan="6">
                                <b class="text-danger">&#8369; <?= $totalpriceCart; ?></b>
                            </td>
                        </tr>
                        <tr>
                            <th>Preferred Method</th>
                            <td colspan="6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="pickup" id="pickup"
                                        name="preferred_method" required onchange="enableCheckout()">
                                    <label class="form-check-label" for="pickup">
                                        Pickup
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="delivery" id="delivery"
                                        name="preferred_method" required onchange="enableCheckout()">
                                    <label class="form-check-label" for="delivery">
                                        Delivery
                                    </label>
                                </div>
                            </td>
                        </tr>




                    </tfoot>
                </table>
            </div>
            <div class="card-footer">
                <?php if (isset($_SESSION['addedOrder'])): ?>
                    <!-- <button style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#placeOrderModal"> Place Order</button> -->

                    <button id="btnOrderProcess" style="float: right;" onclick="btnOrderProcess()" class="btn btn-primary">
                        Check Out</button>
                <?php endif; ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function enableCheckout() {
                // Check if either radio button is selected
                if (document.querySelector('input[name="preferred_method"]:checked')) {
                    document.getElementById("btnOrderProcess").disabled = false; // Enable the button
                } else {
                    document.getElementById("btnOrderProcess").disabled = true; // Disable the button
                }
            }

            // Initially disable the button on page load
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById("btnOrderProcess").disabled = true;
            });

            function confirmDelete(sessionIndex) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'route.php?removeQtySesssion=' + sessionIndex;
                    }
                });
            }

            function confirmDelete(sessionIndex) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'route.php?removeQtySesssion=' + sessionIndex;
                    }
                });
            }

            function btnOrderProcess() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                Swal.fire({
                    title: "Payment Method",
                    text: "Please select payment method!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: '<span style="color: #ffffff">Cash on Delivery</span>',
                    cancelButtonText: '<span style="color: #ffffff">GCash</span>',
                    cancelButtonColor: '#007bff',
                    confirmButtonColor: '#E91E63',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-warning',
                        cancelButton: 'btn btn-primary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#placeOrderModal').modal('show');
                        $('.modal-title').html('Cash On Delivery')
                        $('#paymenttype').val("Cash On Delivery");
                        $('#gcashQr').hide();
                        $('.forms-input').show();
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        $('#placeOrderModal').modal('show');
                        $('.modal-title').html('GCash')
                        $('#paymenttype').val("GCash");
                        $('#gcashQr').show();
                        $('.forms-input').hide();
                    }
                });
            }

            $('#fileInput').change(function () {
                if (this.files.length > 0) {
                    $('#elementsToHide').hide();
                }
            });
        </script>

        <?php include('Modal/getIn_Modal.php');
        include('footer.php'); ?>
</body>

</html>