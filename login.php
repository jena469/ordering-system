<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php'); ?>
    <title>Customer Login | Page</title>
    <style>
    body {
        background-image: url('https://www.visitcornwall.com/sites/default/files/product_image/the_cove_resturant_.jpg');
        background-attachment: fixed;
    }
    </style>
</head>

<body>
    <?php $login = 'login';
    include('navbar.php'); ?>
    <div class="container d-flex justify-content-center" style="padding: 4%;">
        <div class="card shadow" style="width: 40%;">
            <div class="card-header">
                <h4>Login Form</h4>
            </div>
            <div class="card-body" style="padding: 10%;">
                <form action="route.php" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" required name="username" class="form-control">
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

                                <input type="checkbox" onclick="viewPass()" />  
                                <label>Show Password</label>
                            </div>
                        </div>
                    </div>

                    <center>
                        <input type="hidden" name="CustomerLogin" value="CustomerLogin">
                        <button class="btn btn-success" id="submit-btn" disabled>LOGIN</button>
                    </center>
                </form>
            </div>
            <div class="card-footer">
                <center>
                    <p>Dont have an account? <a href="register.php"><u>Sign up now<u></p></a>
                </center>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>

    <script>
        const viewPass = () => {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        $(document).ready(function () {
            $('#password').keyup(function () {
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
</body>

</html>