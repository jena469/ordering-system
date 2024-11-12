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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
		rel="stylesheet">
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
	<title>Admin | Page</title>
</head>
<style>
	.card {
		cursor: pointer;
	}

	a {
		text-decoration: none;
		color: white
	}

	.modal-img {
		max-width: 50%;
		height: auto;
	}

	.modal-content-show-qr {
		background-color: transparent;
		border: none;
	}

	.modal-header {
		outline: none;
	}

	.btn-close {
		font-size: 30px;
	}
</style>

<body>
	<?php
	include "connection/index.php";
	$sql = "SELECT * FROM bank ORDER BY id DESC";
	$result = $conn->query($sql);
	?>
	<div class="wrapper">
		<div id="content">
			<?php include('sidebar.php'); ?>
			<div class="row">
				<div class="col-md-12 mb-4">

					<div class="container mt-5">
						<div class="card shadow-sm p-4 m-2">
							<div class="d-flex justify-content-end">
								<button type="button" class="btn btn-primary btn-circle" id="add" data-bs-toggle="modal"
									data-bs-target="#addBank">
									<i class="fas fa-plus"></i>
								</button>
								<?php
								include "./paymentMethod/modal/add.php";
								?>
							</div>
							<ul class="nav nav-tabs cursor-pointer mt-5">
								<li class=" nav-item">
									<button id="activeButton" class="nav-link active  cursor-pointer"
										onclick="handlePlan('active')">Active
										Plans <span id="activeCount"></span></button>
								</li>
								<li class="nav-item" style="margin-left: 5px;">
									<button id="archiveButton" class="nav-link cursor-pointer"
										onclick="handlePlan('archive')">Archived
										Plans <span id="archiveCount"></span></button>
								</li>
							</ul>
							<div id="all_plans" class="table-responsive">
								<table class="table table-bordered">
									<thead class="table-dark text-center">
										<tr>
											<th>Bank Name</th>
											<th>Account Number</th>
											<th>Name of the owner</th>
											<th>QR</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tbody">
										<?php
										$bankArray = array();
										while ($row = $result->fetch_assoc()) {
											$bankInfo = array(
												'id' => $row['id'],
												'bankName' => $row['bankName'],
												'accountNumber' => $row['accountNumber'],
												'name' => $row['name'],
												'status' => $row['status'],
												'imageData' => $row['image']
											);
											$bankArray[] = $bankInfo;
										}
										$bankJson = json_encode($bankArray);
										?>
										<input id="bank" class="d-none"
											value="<?php echo htmlspecialchars($bankJson); ?>" />
										<?php
										$result->data_seek(0);

										$i = 0;
										while ($bankRow = $result->fetch_assoc()) {
											$i++;
											include "./paymentMethod/modal/showQR.php";

											include "./paymentMethod/modal/edit.php";
										}
										?>
									</tbody>

								</table>
								<?php
								$result->close();
								$conn->close()
									?>
							</div>
						</div>
					</div>



				</div>
				<div class="line"></div>
			</div>
		</div>

		<?php include('footer.php'); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
			data-keyboard="false">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body text-center">
						<div class="spinner-border" role="status">
							<span class="visually-hidden"></span>
						</div>
						<p>Processing...</p>
					</div>
				</div>
			</div>
		</div>
		<script src="./paymentMethod/js/index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>