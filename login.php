<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include('header.php'); ?>
	<title>Customer Login | Page</title>

	<!-- Bootstrap 5.3 CSS CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/0AC6ha+TrsVp0T4FxI6xr9Gm2oW9Bf5D9ahcAz" crossorigin="anonymous">

	<style>
		body {
			background-attachment: fixed;
			font-family: Arial, sans-serif;
			margin: 0;
		}

		.container {
			display: flex;
			min-height: 80vh;
			align-items: center;
			justify-content: center;
		}

		.login-card {
			background: #ffffff;
			border-radius: 15px;
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
			max-width: 400px;
			width: 100%;
			padding: 2rem;

		}

		.main {
			display: flex
		}

		.login-card-header {
			text-align: center;
			margin-bottom: 1.5rem;
		}

		.login-card-header h3 {
			font-weight: 700;
			color: #673ab7;
		}

		.login-card-footer {
			text-align: center;
			margin-top: 1.5rem;
		}

		.btn-custom {
			background-color: #673ab7;
			color: #fff;
			border: none;
			transition: background-color 0.3s;
		}

		.btn-custom:hover {
			background-color: #5e35b1;
		}

		.form-check-label {
			color: #333;
		}

		#password-error {
			color: #d32f2f;
		}
	</style>
</head>

<body>
	<?php $login = 'login';
	include('navbar.php'); ?>
	<div class="container">

		<div class="login-card">
			<div class="login-card-header">
				<h3>Customer Login</h3>
				<p class="text-muted">Welcome back! Please login to your account.</p>
			</div>
			<form action="route.php" method="post">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" id="username" name="username" class="form-control" required
						placeholder="Enter your username">
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" id="password" name="password" class="form-control" required
						placeholder="Enter your password">
					<small id="password-error" class="text-danger"></small>
				</div>
				<div class="form-check mb-4">
					<input class="form-check-input" type="checkbox" id="showPassword" onclick="viewPass()">
					<label class="form-check-label" for="showPassword">Show Password</label>
				</div>
				<input type="hidden" name="CustomerLogin" value="CustomerLogin">
				<div class="d-grid">
					<button class="btn btn-primary btn-md w-100" id="submit-btn" disabled>LOGIN</button>
				</div>
			</form>
			<div class="login-card-footer">
				<p class="mb-0">Don't have an account? <a href="register.php" class="text-primary">Sign up now</a></p>
			</div>
		</div>
	</div>

	<!-- Bootstrap 5.3 JS and Popper.js CDN -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-E7ZrVbMKrF3qzRkFBa4gRGGcUETQ1nTm0EDx/tFpb/nlBE5d+0qQsdAR9iN5w1cf" crossorigin="anonymous">
		</script>

	<script>
		const viewPass = () => {
			const passInput = document.getElementById("password");
			passInput.type = passInput.type === "password" ? "text" : "password";
		};

		document.addEventListener("DOMContentLoaded", function () {
			const passwordInput = document.getElementById("password");
			const submitButton = document.getElementById("submit-btn");
			const passwordError = document.getElementById("password-error");

			passwordInput.addEventListener("keyup", function () {
				const password = passwordInput.value;
				if (password.length < 8) {
					passwordError.textContent = 'Password must be at least 8 characters long';
					submitButton.disabled = true;
				} else {
					passwordError.textContent = '';
					submitButton.disabled = false;
				}
			});
		});
	</script>
	<?php include('footer.php'); ?>
</body>

</html>