<?php session_start(); ?>
  <?php
  if (isset($_SESSION["admin"])) {
    header('location: admin.php');
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php'); ?>
    <title>Admin Login | Page</title>
</head>

<body>
    <div class="container d-flex justify-content-center" style="padding-top: 10%;">
        <div class="card shadow" style="width: 40%;">
            <div class="card-header">
                <h4>Login Form</h4>
            </div>
            <div class="card-body" style="padding: 10%;">
                <form action="route.php" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" required name="username" class="form-control">
                                <input type="hidden" name="AdminLogin" value="AdminLogin">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="password" required name="password" class="form-control">
                                <div id="password-error" style="color: red;"></div>
                            </div>
                            <div class="form-group">
                                <label>Show Password</label>
                                <input type="checkbox" onclick="viewPass()" />
                            </div>
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-success mr-3" id="submit-btn" disabled>LOGIN</button>
                    </center>

                </form>
            </div>
        </div>
    </div>
    <script>
        const viewPass = () => {
            var x = document.getElementById("passInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        $(document).ready(function() {
            $('#password').keyup(function() {
                var password = $(this).val();
                if (password.length < 8) {
                    $('#password-error').text('Password must be at least 8 characters long');
                    $('#submit-btn').prop('disabled', true);
                } else {
                    $('#password-error').text('');
                    $('#submit-btn').prop('disabled', false);
                }
            });
        });
    </script>
    <?php include('footer.php'); ?>
</body>

</html>