<?php include ('route.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include ('header.php'); ?>
    <title>Feedback | Page</title>
    <style>
        body {
            background-image: url('https://www.visitcornwall.com/sites/default/files/product_image/the_cove_resturant_.jpg');
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <?php include ('navbar.php'); ?>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        Feedback Form
                    </div>
                    <div class="card-body">
                        <form action="route.php" method="post">
                            <label for="">Name:</label>
                            <input type="text" name="name" class="form-control" required />
                            <br><label for="">Services:</label>
                            <select name="review" class="form-control" required>
                                <option value="Product Qulity">Product Qulity</option>
                                <option value="Seller Service">Seller Service</option>
                                <option value="Delivery Speed">Delivery Speed</option>
                            </select>
                            <br><label for="">Rates:</label>
                            <select name="rates" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <br><label for="">Message:</label>
                            <textarea name="comment" class="form-control" cols="30" rows="5"></textarea required><br><br>
                    <input type="hidden" name="AddFeedBack" value="AddFeedBack" />
                    <center><button type="submit" class="btn btn-primary">Send Message</button></center>
                </form>
            </div>
        </div>
            </div>
            <div class="col-md-6">
            <div class="jumbotron">
                <h3 class="display-10">Explore what our customers have to say!</h3>
                <div style="
    max-height: 414px;
    overflow-x: auto;
    margin: 10px;
">
                    <?php getReviewGlobal(); ?>
                </div>
            </div>
            </div>
        </div>
    </div>

    <?php include ('footer.php'); ?>
</body>

</html>