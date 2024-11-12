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
        $('#checkout_id').val(ckid);
        $('#addDeliveryProof').modal('show');

    }

    const handleClick = (isApproved = true, checkoutID) => {
        const baseTxt = isApproved ? "approve" : "reject";

        if (isApproved) {
            // Approval SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to ${baseTxt} this order?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${baseTxt} it!`
            }).then(async (result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Approved!',
                        'The action has been approved.',
                        'success'
                    );

                    // Send data to PHP
                    await fetch('route.php', {
                        method: 'POST',
                        credentials: "same-origin",
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            isApproved,
                            checkoutID,
                            reason: ""
                        })
                    });

                    // Redirect after delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000); // Delay of 1 second (1000 milliseconds)
                }
            });
        } else {
            // Rejection SweetAlert with TextArea
            Swal.fire({
                title: 'Reason for rejection',
                input: 'textarea',
                inputLabel: 'Please provide a reason for rejecting this order',
                inputPlaceholder: 'Enter your reason here...',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Reject Order',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const reason = result.value;
                    console.log(reason)
                    // Proceed only if there's a reason provided
                    if (reason) {
                        Swal.fire(
                            'Rejected!',
                            'The order has been rejected.',
                            'error'
                        );

                        // Send data to PHP
                        await fetch('route.php', {
                            method: 'POST',
                            credentials: "same-origin",
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                isApproved,
                                checkoutID,
                                reason // Send the reason for rejection
                            })
                        });

                        setTimeout(() => {
                            window.location.href =
                                './parcelClient.php'; // Redirect to another page
                        }, 1000); // Delay of 1 second (1000 milliseconds)
                    } else {
                        Swal.fire(
                            'No Reason Provided',
                            'You must provide a reason for rejection.',
                            'warning'
                        );
                    }
                }
            });
        }
    }
    </script>

    <?php include('Modal/deliveryProof_modal.php');
     include('footer.php');?>
</body>

</html>