<?php include('route.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<?php include('header.php'); ?>
	<title>Receipt | Page</title>
	<style>
		#table_style {
			font-family: Arial, sans-serif;
			padding: 10px;
			max-width: 350px;
			margin: auto;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 0.9em;
		}

		th,
		td {
			padding: 5px;
			border: none;
		}

		.header,
		.footer {
			padding-bottom: 5px;
			margin-bottom: 5px;
		}

		.centered {
			text-align: center;
			font-weight: bold;
		}

		.footer {
			border-top: 1px solid #000;
			padding-top: 5px;
			margin-top: 10px;
			font-weight: bold;
		}

		.total {
			font-weight: bold;
		}

		.print-btn {
			margin-top: 10px;
			display: block;
			width: 100%;
		}
	</style>
</head>

<body>
	<?php include('navbar.php'); ?>

	<div class="container mb-5" id="table_style">
		<div class="card print-content">
			<div class="card-header">
				<div class="row">
					<div class="col-md-12 text-center">
						<h5>Receipt</h5>
					</div>
				</div>
			</div>
			<div class="card-body">

				<table>
					<thead>
						<tr class="header">
							<th colspan="4" class="text-center"
								style="font-weight: bold; border-bottom: 1px solid #000;">Bryan Mini Grocery</th>
						</tr>
						<tr class="centered m-0 p-0">
							<td colspan="4">Rizal St Brg 8 Poblacion</td>
						</tr>
						<tr class="centered m-0 p-0">
							<td colspan="4">Gen. Tinio, N.E.</td>
						</tr>
					</thead>
					<tbody>
						<tr class="centered">
							<td colspan="4">ORDER SLIP</td>
						</tr>
						<tr>
							<td colspan="4">
								<span class="fw-bold">Delivery Address:</span>
								<?= ucwords(strtolower($cartObj->getaddressForReciept($_SESSION['reg_id'])[0])) ?>
							</td>
						</tr>
						<tr>
							<td colspan="4">Date: <?= date('Y-m-d') ?></td>
						</tr>
						<tr>
							<td class="fw-bold">Description</td>
							<td class="fw-bold">Price</td>
							<td class="fw-bold">Qty</td>
							<td class="fw-bold">Amount</td>
						</tr>
						<?php
						$totalamount = 0; // Initialize total amount
						foreach ($_SESSION['getReciept'] as $rows):
							$items = $cartObj->getMenuForReciept($rows['menuId']);
							$subtotal = ($items[1] * $rows['qty']); // Calculate subtotal
							$totalamount += $subtotal; // Accumulate total amount
							?>
							<tr>
								<td><?= htmlspecialchars($items[0]) ?></td>
								<td><?= htmlspecialchars(number_format($items[1], 2)) ?></td>
								<td><?= htmlspecialchars($rows['qty']) ?></td>
								<td><?= htmlspecialchars(number_format($subtotal, 2)) ?></td>
							</tr>
						<?php endforeach; ?>

						<tr style="border-top: 1px solid #000;">
							<td colspan="3" class="total" style="padding-top: 10px">Subtotal</td>
							<td class="total" style="padding-top: 10px">
								<?= htmlspecialchars(number_format($totalamount, 2)) ?>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="total">Amount Due</td>
							<td class="total"><?= htmlspecialchars(number_format($totalamount, 2)) ?></td>
						</tr>
						<tr class="footer" style="font-size: 20px">
							<td colspan="3" class="total">Total Amount</td>
							<td class="total"><?= htmlspecialchars(number_format($totalamount, 2)) ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" class="text-center" style="font-size: 15px">
								<strong><?php echo ucwords(strtolower(isset($_SESSION['customerName']) ? $_SESSION['customerName'] : 'Customer')) ?></strong>
							</td>
						</tr>
						<tr class="centered footer">
							<td colspan="4">Received By</td>
						</tr>
					</tfoot>
				</table>
				<button class="btn btn-primary float-right print-btn">PRINT</button>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			$('.print-btn').on('click', function () {
				$('.print-btn').hide();
				var content = $('.print-content').html();
				var printWindow = window.open('', '_blank');
				printWindow.document.open();
				printWindow.document.write(
					'<html><head><title>Print</title>' +
					'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">' +
					`<style>
						@media print { 
							.print-btn { 
										display: none; 
							}
							table {
								width: 100%;
								border-collapse: collapse;
								font-size: 0.9em;
							}
							th,
							td {
								padding: 5px;
								border: none;
							}
							.header,
							.footer {
								padding-bottom: 5px;
								margin-bottom: 5px;
							}
							.centered {
								text-align: center;
								font-weight: bold;
							}
							.footer {
								border-top: 1px solid #000;
								padding-top: 5px;
								margin-top: 10px;
								font-weight: bold;
								font-size:10px
							}
							.total {
								font-weight: bold;
							}
						}
				</style>` +

					'</head><body>'
				);
				printWindow.document.write(content);
				printWindow.document.write('</body></html>');
				printWindow.document.close();
				printWindow.onload = function () {
					printWindow.print();
					printWindow.close();
				};
				$('.print-btn').show(); // Show the print button after printing
			});
		</script>

		<?php include('footer.php'); ?>
</body>

</html>