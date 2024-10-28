<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include('header.php'); ?>
	<title>Admin Login | Page</title>
	<style>
	body {
		background-image: url('https://www.visitcornwall.com/sites/default/files/product_image/the_cove_resturant_.jpg');
		background-attachment: fixed;
	}
	</style>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="container d-flex justify-content-center" style="padding: 4%;">
		<div class="card" style="width: 70%;">
			<div class="card-header">
				<h4>Register Now</h4>
			</div>
			<div class="card-body" style="padding: 10%;">
				<form action="route.php" method="post">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" required name="fname" class="form-control">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Middle Name</label>
								<input type="text" name="m_name" class="form-control">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" required name="lname" class="form-control">
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Username</label>
								<input type="text" required name="username" class="form-control">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Password</label>
								<input type="password" required name="password" class="form-control" id="password">
								<div id="password-error" style="color: red;"></div>
							</div>
						</div>

						<div class="col">
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" required name="confirm_password" class="form-control"
									id="confirm_password">
								<div id="password-error2" style="color: red;"></div>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<input type="hidden" name="CustomerRegister" value="CustomerRegister">
							<button class="btn btn-success mr-3" id="submit-btn" disabled>Register</button>
							<a href="login.php" class="btn btn-primary">Back</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
	$(document).ready(function() {
		function validatePasswords() {
			var password = $('#password').val();
			var confirmPassword = $('#confirm_password').val();

			var passwordValid = password.length >= 8;
			var passwordsMatch = password === confirmPassword;

			// Check password length
			if (!passwordValid) {
				$('#password-error').text('Password must be at least 8 characters long');
			} else {
				$('#password-error').text('');
			}

			// Check if passwords match
			if (!passwordsMatch) {
				$('#password-error2').text('Passwords do not match');
			} else {
				$('#password-error2').text('');
			}

			// Enable submit button only if all conditions are met
			if (passwordValid && passwordsMatch) {
				$('#submit-btn').prop('disabled', false);
			} else {
				$('#submit-btn').prop('disabled', true);
			}
		}

		// Attach the validation function to input events
		$('#password, #confirm_password').on('input', validatePasswords);

	});
	</script>
	<?php include('footer.php'); ?>
</body>

</html>