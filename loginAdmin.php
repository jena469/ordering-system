<?php
session_start();

// Redirect to admin page if already logged in
if (isset($_SESSION["admin"])) {
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/0AC6ha+TrsVp0T4FxI6xr9Gm2oW9Bf5D9ahcAz" crossorigin="anonymous">

    <?php include('header.php'); ?>
    <title>Admin Login | Page</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-5" style="max-width: 400px; width: 100%; border-radius: 12px;">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Admin Login</h2>
                <p class="text-muted">Access your admin dashboard</p>
            </div>
            <div class="card-body p-0">
                <form action="route.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required
                            placeholder="Enter your username">
                        <input type="hidden" name="AdminLogin" value="AdminLogin">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required
                            placeholder="Enter your password">
                        <small id="password-error" class="text-danger"></small>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="showPassword"
                            onclick="togglePasswordVisibility()">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>
                    <div class="d-grid mb-2">
                        <button class="btn btn-primary btn-lg w-100" id="submit-btn" disabled>Login</button>
                    </div>
                    <!-- <div class="text-center">
                        <small class="text-muted">Forgot your password? <a href="#" class="text-primary">Reset it
                                here</a></small>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-E7ZrVbMKrF3qzRkFBa4gRGGcUETQ1nTm0EDx/tFpb/nlBE5d+0qQsdAR9iN5w1cf" crossorigin="anonymous">
        </script>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }

        document.addEventListener("DOMContentLoaded", function () {
            const passwordInput = document.getElementById("password");
            const submitButton = document.getElementById("submit-btn");
            const passwordError = document.getElementById("password-error");

            // Check password length and enable/disable the submit button
            passwordInput.addEventListener("keyup", function () {
                if (passwordInput.value.length < 8) {
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