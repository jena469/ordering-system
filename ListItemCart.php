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
							<th>Preferred Method</th>
							<td>
								<div class="form-check">
									<input class="form-check-input" type="radio" value="pickup" id="pickup"
										name="preferred_method" required onchange="toggleShippingFee()">
									<label class="form-check-label" for="pickup">
										Pickup
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" value="delivery" id="delivery"
										name="preferred_method" required onchange="toggleShippingFee()">
									<label class="form-check-label" for="delivery">
										Delivery
									</label>
								</div>
								<small id="minimumOrderNote" style="display: none; color: red;">* Minimum order of
									&#8369;500 required for delivery</small>
							</td>
							<th colspan="2">Payment Method</th>
							<td colspan="3">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="gcash" id="gcash"
										name="payment_method" required>
									<label class="form-check-label" for="gcash">
										GCASH
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" value="cod" id="cod"
										name="payment_method" required>
									<label class="form-check-label" for="cod">
										CASH ON DELIVERY/PICK-UP
									</label>
								</div>
							</td>
						</tr>

						<tr>
							<th>Amount</th>
							<td colspan="6">
								<b class="text-danger">&#8369; <span
										id="baseTotal"><?php echo $totalpriceCart; ?>.00</span></b>
							</td>
						</tr>
						<tr id="shippingFeeRow" style="display: none;">
							<th>Shipping Fee</th>
							<td colspan="6">
								<b class="text-danger">&#8369; <span id="shippingFee">50.00</span></b>
							</td>
						</tr>
						<tr>
							<th>Total Price</th>
							<td colspan="6">
								<b class="text-danger">&#8369; <span
										id="finalTotal"><?php echo $totalpriceCart; ?>.00</span></b>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="card-footer">
				<?php if (isset($_SESSION['addedOrder'])): ?>
				<!-- <button style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#placeOrderModal"> Place Order</button> -->
				<button id="btnOrderProcess" style="float: right;" onclick="btnOrderProcess()" class="btn btn-primary">
					Check Out
				</button>
				<?php endif; ?>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
		function toggleShippingFee() {
			const shippingFeeRow = document.getElementById("shippingFeeRow");
			const baseTotal = parseFloat(document.getElementById("baseTotal").textContent);
			const shippingFee = 50;
			const deliveryOption = document.getElementById("delivery").checked;
			const finalTotalElement = document.getElementById("finalTotal");
			const minimumOrderNote = document.getElementById("minimumOrderNote");
			const checkoutButton = document.getElementById("btnOrderProcess");

			shippingFeeRow.style.display = deliveryOption ? "table-row" : "none";

			if (deliveryOption && baseTotal < 500) {
				minimumOrderNote.style.display = "block";
				checkoutButton.disabled = true;
			} else {
				minimumOrderNote.style.display = "none";
			}

			const finalTotal = deliveryOption ? baseTotal + shippingFee : baseTotal;
			finalTotalElement.textContent = finalTotal.toFixed(2);

			checkCheckoutButtonState();
		}


		function checkCheckoutButtonState() {
			const pickup = document.getElementById('pickup').checked;
			const delivery = document.getElementById('delivery').checked;
			const gcash = document.getElementById('gcash').checked;
			const cod = document.getElementById('cod').checked;
			const baseTotal = parseFloat(document.getElementById("baseTotal").textContent);
			const checkoutButton = document.getElementById("btnOrderProcess");

			if ((pickup || delivery) && (gcash || cod)) {
				if (delivery && baseTotal < 500) {
					checkoutButton.disabled = true;
				} else {
					checkoutButton.disabled = false;
				}
			} else {
				checkoutButton.disabled = true;
			}
		}

		document.getElementById('pickup').addEventListener('change', checkCheckoutButtonState);
		document.getElementById('delivery').addEventListener('change', () => {
			toggleShippingFee();
			checkCheckoutButtonState();
		});
		document.getElementById('gcash').addEventListener('change', checkCheckoutButtonState);
		document.getElementById('cod').addEventListener('change', checkCheckoutButtonState);

		checkCheckoutButtonState();

		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("btnOrderProcess").disabled = true;
		});;



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
			const payment_method = document.querySelector('input[name="payment_method"]:checked')?.value;
			const pickup = document.getElementById('pickup').checked;
			const delivery = document.getElementById('delivery').checked;
			const gcash = document.getElementById('gcash').checked;
			const cod = document.getElementById('cod').checked;

			if (!(pickup || delivery)) {
				Swal.fire({
					title: 'Error!',
					text: 'Please select a preferred delivery method.',
					icon: 'error'
				});
				return;
			}

			if (!(gcash || cod)) {
				Swal.fire({
					title: 'Error!',
					text: 'Please select a payment method.',
					icon: 'error'
				});
				return;
			}

			if (payment_method === "cod") {
				$('#placeOrderModal').modal('show')
				$('.modal-title').html('Cash On Delivery')
				$('#paymenttype').val("Cash On Delivery")
				$('#gcashQr').hide()
				$('.forms-input').show()
			} else {
				$('#placeOrderModal').modal('show')
				$('.modal-title').html('GCash')
				$('#paymenttype').val("GCash")
				$('#gcashQr').show()
				$('.forms-input').hide()
			}

		}

		// function btnOrderProcess() {
		//     const preferredMethod = document.querySelector('input[name="preferred_method"]:checked')?.value;
		//     let confirmButtonText = '<span style="color: #ffffff">Cash on Delivery</span>';
		//     if (preferredMethod === "pickup") {
		//         confirmButtonText = '<span style="color: #ffffff">Cash on Pickup</span>';
		//     }

		//     const swalWithBootstrapButtons = Swal.mixin({
		//         customClass: {
		//             confirmButton: "btn btn-success",
		//             cancelButton: "btn btn-danger"
		//         },
		//         buttonsStyling: false
		//     });
		//     Swal.fire({
		//         title: "Payment Method",
		//         text: "Please select payment method!",
		//         icon: "question",
		//         showCancelButton: true,
		//         confirmButtonText: confirmButtonText,
		//         cancelButtonText: '<span style="color: #ffffff">GCash</span>',
		//         cancelButtonColor: '#007bff',
		//         confirmButtonColor: '#E91E63',
		//         reverseButtons: true,
		//         customClass: {
		//             confirmButton: 'btn btn-warning',
		//             cancelButton: 'btn btn-primary'
		//         }
		//     }).then((result) => {
		//         if (result.isConfirmed) {
		//             $('#placeOrderModal').modal('show');
		//             $('.modal-title').html('Cash On Delivery');
		//             $('#paymenttype').val("Cash On Delivery");
		//             $('#gcashQr').hide(); // Hide GCash related fields
		//             $('.forms-input').show(); // Show address and phone input
		//         } else if (result.dismiss === Swal.DismissReason.cancel) {
		//             $('#placeOrderModal').modal('show');
		//             $('.modal-title').html('GCash');
		//             $('#paymenttype').val("GCash");
		//             $('#gcashQr').show(); // Show GCash receipt upload field
		//             $('.forms-input').hide(); // Hide address and phone input
		//         }
		//     });
		// }

		$('#fileInput').change(function() {
			if (this.files.length > 0) {
				$('#elementsToHide').hide();
			}
		});
		</script>

		<?php include('Modal/getIn_Modal.php');
        include('footer.php'); ?>
</body>

</html>