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
	<title>Admin | Page</title>
</head>
<style>
.card {
	cursor: pointer;
}
</style>

<body>
	<div class="wrapper">
		<div id="content">
			<?php include('sidebar.php'); ?>
			<div class="row">
				<div class="col-md-6 mb-4">
					<div class="card shadow" onclick="window.location.href='parcelClient.php'">
						<div class="card-header">
							<h4>Order List</h4>
						</div>
						<div class="card-body text-center">
							<div class="row">
								<div class="col">
									<h2><i class="fas fa-chart-pie"></i></h2>
								</div>
								<div class="col">
									<h2><?php echo totalParcel(); ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 mb-4">
					<div class="card shadow" onclick="window.location.href='foodMenu.php'">
						<div class="card-header">
							<h4>Products</h4>
						</div>
						<div class="card-body text-center">
							<div class="row">
								<div class="col">
									<h2><i class="fas fa-list"></i></h2>
								</div>
								<div class="col">
									<h2><?php echo totalMenu(); ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col">
					<div class="card shadow" onclick="window.location.href='review.php'">
						<div class="card-header">
							<h4>Reviews</h4>
						</div>
						<div class="card-body text-center">
							<div class="row">
								<div class="col">
									<h2><i class="fas fa-comment"></i></h2>
								</div>
								<div class="col">
									<h2><?php echo totalReviews(); ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col">
					<div class="card shadow" onclick="window.location.href='foodCategory.php'">
						<div class="card-header">
							<h4>Category</h4>
						</div>
						<div class="card-body text-center">
							<div class="row">
								<div class="col">
									<h2><i class="fas fa-clipboard-list"></i></h2>
								</div>
								<div class="col">
									<h2><?php echo totalCategory(); ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="line"></div>
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>

</html>