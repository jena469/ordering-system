<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-9ndCyUaQ7F1skYknY4wrF0xHmbuNh8Zz48XIv6Fw6Md8Ff9w4IqOnw2i9NyPg5lF" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeo9F7jHg9u7f1L8Xg8d5e1Zj34gF3cDhzUVF1p8yYHwdNj6" crossorigin="anonymous">
	</script>

</head>
<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Poppins', sans-serif;
}

body {
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	/* background: #4070f4; */
}

.wrapper {
	position: relative;
	max-width: 470px;
	width: 100%;
	background: #fff;
	padding: 34px;
	border-radius: 6px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.wrapper h2 {
	position: relative;
	font-size: 22px;
	font-weight: 600;
	color: #333;
}

.wrapper h2::before {
	content: '';
	position: absolute;
	left: 0;
	bottom: 0;
	height: 3px;
	width: 28px;
	border-radius: 12px;
	background: #4070f4;
}

.wrapper form {
	margin-top: 30px;
}

.wrapper form .input-box {
	height: 52px;
	margin: 18px 0;
}

form .input-box input {
	height: 100%;
	width: 100%;
	outline: none;
	padding: 0 15px;
	font-size: 17px;
	font-weight: 400;
	color: #333;
	border: 1.5px solid #C7BEBE;
	border-bottom-width: 2.5px;
	border-radius: 6px;
	transition: all 0.3s ease;
}

.input-box input:focus,
.input-box input:valid {
	border-color: #4070f4;
}

form .policy {
	display: flex;
	align-items: center;
}

form h3 {
	color: #707070;
	font-size: 14px;
	font-weight: 500;
	margin-left: 10px;
}

.input-box.button input {
	color: #fff;
	letter-spacing: 1px;
	border: none;
	background: #4070f4;
	cursor: pointer;
}

.input-box.button input:hover {
	background: #0e4bf1;
}

form .text h3 {
	color: #333;
	width: 100%;
	text-align: center;
}

form .text h3 a {
	color: #4070f4;
	text-decoration: none;
}

form .text h3 a:hover {
	text-decoration: underline;
}
</style>

<body>
	<div class="wrapper">
		<h2>Registration</h2>
		<form action="proces/insert.php" method="post" onsubmit="return checkForm()">
			<div class="input-box">
				<input type="text" placeholder="Enter your first name" required name="fname">
			</div>
			<div class="input-box">
				<input type="text" placeholder="Enter your middle name" name="m_name">
			</div>
			<div class="input-box">
				<input type="text" placeholder="Enter your last name" required name="lname">
			</div>
			<div class="input-box">
				<input type="text" placeholder="Enter your email" required name="username">
				<span class="error-message" id="emailExistsError"
					style="display: none;color: red;text-align:center;">Email already exists</span>
			</div>
			<div class="input-box">
				<input type="password" placeholder="Create password" required id="password" name="password">
				<div id="password-error" style="color: red;"></div>
			</div>
			<div class="input-box">
				<input type="password" placeholder="Confirm password" id="confirm_password" required
					name="confirm_password">
				<div id="password-error2" style="color: red; "></div>
			</div>
			<br>
			<div id="passwordShort" style="color: red;"></div>
			<div class="input-box button my-0">
				<input type="hidden" name="CustomerRegister" value="CustomerRegister">
				<!-- <button class="btn btn-success mr-3" id="submit-btn">Register</button> -->
				<input type="submit" id="submit-btn" value="Register">
			</div>
			<div class="text display-5">
				<h3>Already have an account? <a href="login.php">Login now</a></h3>
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
	function checkForm() {
		var firstName = document.querySelector('input[name="fname"]').value.trim();
		var m_name = document.querySelector('input[name="m_name"]').value.trim();
		var lastName = document.querySelector('input[name="lname"]').value.trim();
		var email = document.querySelector('input[name="username"]').value.trim();
		var password = document.querySelector('input[name="password"]').value;
		var confirmPassword = document.querySelector('input[name="confirm_password"]').value;
		var emailExistsErrorSpan = document.getElementById('emailExistsError');

		if (firstName === '' || lastName === '' || email === '' || password === '' || confirmPassword === '') {
			Swal.fire({
				icon: 'warning',
				title: 'Incomplete Form',
				text: 'Please fill up all the fields!',
			});
			return false;
		}

		if (password !== confirmPassword) {
			document.getElementById('password-error2').innerText = 'Passwords do not match';
			return false;
		} else {
			document.getElementById('password-error2').innerText = '';
		}

		if (password.length < 8) {
			document.getElementById('passwordShort').innerText = 'Passwords is too short';
			return false;
		} else {
			document.getElementById('passwordShort').innerText = '';
		}

		// var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		// if (!emailRegex.test(email)) {
		// 	Swal.fire({
		// 		icon: 'error',
		// 		title: 'Invalid email address!',
		// 		text: 'Please enter a valid email address.',
		// 	});
		// 	return false;
		// }

		fetch('./proces/check_email.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'email=' + encodeURIComponent(email),
			})
			.then(response => response.text())
			.then(response => {
				if (response === 'exists') {
					emailExistsErrorSpan.style.display = 'block';
				} else {
					emailExistsErrorSpan.style.display = 'none';
					// document.querySelector('form').submit();
					registerUser(firstName, m_name, lastName, email, password);
				}
			})
			.catch(error => {
				console.error('Error:', error);
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'An error occurred while checking email.',
				});
			});

		return false;
	}

	function registerUser(firstName, m_name, lastName, email, password) {
		const formData = new URLSearchParams();
		formData.append('fname', firstName);
		formData.append('m_name', m_name);
		formData.append('lname', lastName);
		formData.append('username', email);
		formData.append('password', password);
		formData.append('CustomerRegister', 'CustomerRegister');

		return fetch('proces/insert.php', {
				method: 'POST',
				body: formData,
			})
			.then(response => response.text())
			.then(response => {
				if (response.includes("success")) {
					Swal.fire({
						icon: 'success',
						title: 'Account Created',
						text: 'Successfully created an account!',
					}).then(() => {

						window.location.href = "index.php";
					});
					return true;
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Registration Failed',
						text: response,
					});
					return false; // Registration failed
				}
			})
			.catch(error => {
				console.error('Error:', error);
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'An error occurred while registering.',
				});
				return false;
			});
	}
	</script>
</body>

</html>