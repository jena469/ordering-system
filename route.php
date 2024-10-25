<?php
require('./Class/Db.php');
require('./Class/Rates.php');

$rateObj = new Rates();

if (isset($_GET['list_reviews']) && isset($_GET['menu_id'])) {

    $response = $rateObj->getReviews($_GET['menu_id']);

    echo json_encode([
        'message' => $response,
        'status' => 'success'
    ]);

    die();
}


if (!isset($_POST['CheckOut'])): ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<?php endif; ?>

	<?php
    session_start();
    require('./Class/TilesCounter.php');
    require('./Class/ParcelClient.php');
    require('./Class/FoodMenu.php');
    require('./Class/Review.php');
    require('./Class/FoodCategory.php');
    require('./Class/Login.php');
    require('./Class/Cart.php');

    $showTotalDue = 0;
    $SessionIndex = 0;

    $tileObj = new TilesCounter();
    $parcelObj = new ParcelClients();
    $menuObj = new FoodMenu();
    $reviewObj = new Review();
    $catObj = new FoodCategory();
    $loginObj = new Login();
    $cartObj = new Cart();

    $totalpriceCart = 0;



    if (isset($_POST['action_post_reviews'])) {

        $user_id = isset($_SESSION['reg_id']) ? $_SESSION['reg_id'] : 0;

        $response = $rateObj->saveRates($_POST, $user_id);

        if ($response['status'] == 'success') {
            url(
                'success',
                'Success save reviews.',
                'index.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'index.php'
            );
        }
        die();
    }


    if (isset($_POST['CustomerRegister'])) {
        $response = $loginObj->registerCustomer(
            $_POST
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Successfully Registered you may now logged In this account.',
                'login.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'login.php'
            );
        }

        die();
    }

    if (isset($_POST['AddFeedBack'])) {
        $response = $reviewObj->addReviews(
            $_POST
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Successfully send message.',
                'setReview.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'setReview.php'
            );
        }

        die();
    }

    if (isset($_POST['CustomerLogin'])) {
        $response = $loginObj->customerLogin(
            $_POST
        );

        if ($response['status'] == 'success') {

            $_SESSION['reg_id'] = $response['message']['reg_id'];
            $_SESSION['customerName'] = $response['message']['fname'] . ' ' . $response['message']['m_name'] . ' ' . $response['message']['lname'];
            $_SESSION['user'] = 'user';

            url(
                'success',
                'Login Successfully',
                'index.php'
            );
        } elseif ($response['status'] == 'warning') {
            url(
                'warning',
                $response['message'],
                'login.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'login.php'
            );
        }

        die();
    }

    if (isset($_POST['UpdateProfile'])) {
        $response = $loginObj->updateAccountAdmin(
            $_POST
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Account Updated Successfully',
                'admin.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'admin.php'
            );
        }

        die();
    }

    if (isset($_POST['AdminLogin'])) {
        $response = $loginObj->adminLogin(
            $_POST
        );

        if ($response['status'] == 'success') {

            $_SESSION['admin_id'] = $response['message']['admin_id'];
            $_SESSION['name'] = $response['message']['fname'] . ' ' . $response['message']['lname'];
            $_SESSION['gender'] = $response['message']['gender'];
            $_SESSION['admin'] = 'admin';

            url(
                'success',
                'Login Successfully',
                'admin.php'
            );
        } elseif ($response['status'] == 'warning') {
            url(
                'warning',
                $response['message'],
                'loginAdmin.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'loginAdmin.php'
            );
        }

        die();
    }

    if (isset($_POST['AddFoodCategory'])) {
        $response = $catObj->addCategory(
            $_POST
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Added New Category',
                'FoodCategory.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'FoodCategory.php'
            );
        }

        die();
    }
    if (isset($_POST['UpdateFoodCategory'])) {
        $response = $catObj->updateCategory(
            $_POST
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Updated Category',
                'FoodCategory.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'FoodCategory.php'
            );
        }


        die();
    }
    if (isset($_POST['Addgallery'])) {
        if (isset($_FILES['file']['name'])) {
            $response = $galleryObj->addGallery($_FILES);

            if ($response['status'] == 'success') {
                url(
                    'success',
                    'Image Uploaded Successfully',
                    'gallery.php'
                );
            } else {

                url(
                    'error',
                    $response['message'],
                    'gallery.php'
                );
            }
        } else {
            url(
                'warning',
                'Please Choose Image!',
                'gallery.php'
            );
        }

        die();
    }

    if (isset($_GET['removeGallery'])) {
        $response = $galleryObj->removeGallery($_GET['removeGallery']);

        if ($response['status'] == 'success') {
            url(
                'success',
                'Deleted Successfully',
                'gallery.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'gallery.php'
            );
        }

        die();
    }


    if (isset($_POST['AddFood'])) {
        $response = $menuObj->addFoodMenu(
            $_POST,
            $_FILES
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Successfully Save.',
                'foodMenu.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'foodMenu.php'
            );
        }

        die();
    }

    if (isset($_POST['updateProof'])) {
        $response = $menuObj->updateProof(
            $_POST,
            $_FILES
        );

        // if ($response['status'] == 'success') {
        //     url(
        //         'success',
        //         'Successfully Save.',
        //         'foodMenu.php'
        //     );
        // } else {
    
        //     url(
        //         'error',
        //         $response['message'],
        //         'foodMenu.php'
        //     );
        // }
    
        // die();
    }

    if (isset($_POST['UpdateFood'])) {

        $response = $menuObj->updateFoodMenu(
            $_POST,
            $_FILES
        );

        if ($response['status'] == 'success') {
            url(
                'success',
                'Successfully Save.',
                'foodMenu.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'foodMenu.php'
            );
        }

        die();
    }

    if (isset($_GET['removeFoodMenu'])) {
        $response = $menuObj->removeFoodMenu($_GET['removeFoodMenu']);

        if ($response['status'] == 'success') {
            url(
                'success',
                'Removed Successfully',
                'foodMenu.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'foodMenu.php'
            );
        }

        die();
    }

    if (isset($_GET['removeReview'])) {
        $response = $reviewObj->removeFoodMenu($_GET['removeReview']);

        if ($response['status'] == 'success') {
            url(
                'success',
                'Removed Successfully',
                'review.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'review.php'
            );
        }

        die();
    }

    if (isset($_GET['removeFoodCategory'])) {
        $response = $catObj->removeFoodCategory($_GET['removeFoodCategory']);

        if ($response['status'] == 'success') {
            url(
                'success',
                'Removed Successfully',
                'foodCategory.php'
            );
        } else {

            url(
                'error',
                $response['message'],
                'foodCategory.php'
            );
        }

        die();
    }

    if (isset($_POST['AddCart'])) {
        if (!isset($_SESSION['user'])) {
            url(
                'warning',
                'Log In First Before You order!',
                'login.php'
            );
            die();
        }

        $_SESSION['addedOrder'][] = $_POST;

        url(
            'success',
            'Successfully Added Card.',
            'index.php'
        );

        die();
    }

    if (isset($_POST['CheckOut'])) {

        $response = $cartObj->saveCheckout(
            $_SESSION['addedOrder'],
            $_POST,
            $_FILES
        );

        if ($response['status'] == 'success') {

            unset($_SESSION['getReciept']);

            $_SESSION['getReciept'] = $_SESSION['addedOrder'];

            unset($_SESSION['addedOrder']);

            echo json_encode([
                'message' => 'Order placed Successfully.',
                'status' => 'success'
            ]);
        } elseif ($response['status'] == 'warning') {
            echo json_encode([
                'message' => 'Empty Cart Please Try Agin!',
                'status' => 'warning'
            ]);
        } else {
            echo json_encode([
                'message' => $response['message'],
                'error' => 'warning'
            ]);
        }
        die();
    }

    if (isset($_GET['plusQtySesssion'])) {
        $index = $_GET['plusQtySesssion'];

        $_SESSION['addedOrder'][$index]['qty'] += 1;

        echo "<script>window.location='ListItemCart.php'</script>";
        die();
    }

    if (isset($_GET['minusQtySesssion'])) {
        $index = $_GET['minusQtySesssion'];

        if ($_SESSION['addedOrder'][$index]['qty'] != 0)

            $_SESSION['addedOrder'][$index]['qty'] -= 1;

        echo "<script>window.location='ListItemCart.php'</script>";
        die();
    }

    if (isset($_GET['removeQtySesssion'])) {
        $index = $_GET['removeQtySesssion'];

        unset($_SESSION['addedOrder'][$index]);

        echo "<script>window.location='ListItemCart.php'</script>";
        die();
    }

    function showGallery()
    {
        global $galleryObj;
        $i = 1;

        foreach ($galleryObj->getGallery() as $row) {
            echo "
                    <a href='" . $row['images'] . "' class='image-tile col-md-6' data-abc=true>
                        <img class='rounded m-2' style='width:100%; height:70%;' src='" . $row['images'] . "' alt='Image-" . $i . " class='rouded''>
                    </a>
                ";
            $i++;
        }
    }

    function getPreviewCartCategory($menuId, $qty)
    {
        global $cartObj;
        global $showTotalDue;
        global $SessionIndex;
        global $totalpriceCart;

        $alltotal = 0;
        $finalTotal = 0;

        foreach ($cartObj->getPreviewCartCategory($menuId) as $row) {
            $showTotalDue += $row['price'];

            $finalTotal = $row['price'] * $qty;

            $totalpriceCart += $finalTotal;

            echo "
                    <tr>
                        <td>
                        <center><img src='" . $row['pic'] . "' width='60' height='60' style='border-radius: 50%;'></center>
                        </td>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td style='width:30%;'>
                            <div class='row' style='padding:5%;'>
                                <div class='col-md-3'>
                                    <center>
                                        <a href='route.php?plusQtySesssion=" . $SessionIndex . "' class='btn btn-primary'>
                                            +
                                        </a>
                                    </center>
                                </div>
                                <div class='col'>
                                    <input read-only style='text-align:center;' type='number' class='form-control' value='" . $qty . "'/>
                                </div>
                                <div class='col-md-3'>
                                    <center>
                                        <a href=' route.php?minusQtySesssion=" . $SessionIndex . "' class='btn btn-danger'>
                                        -
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </td>
                        <td>" . $row['price'] . "</td>
                        <td>" . $finalTotal . "</td>
                        <td>
                            <a href=' route.php?removeQtySesssion=" . $SessionIndex . "' class='btn btn-danger'>
                                <i class='fas fa-minus-square'></i>
                            </a>
                        </td>
                    </tr>
                ";

            $SessionIndex++;
        }
    }

    function showCategory()
    {
        global $catObj;

        foreach ($catObj->getFoodCategory() as $row) {
            echo '
                    <li class="list-group-item"><a href="landingpage.php?catId=' . $row['cat_id'] . '">' . $row['cat_title'] . '</a></li>
                ';
        }
    }

    function showAllMenu()
    {
        global $menuObj;
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;

        foreach ($menuObj->getShowAllMenu() as $row) {
            $regId = isset($_SESSION['reg_id']) ? $_SESSION['reg_id'] : null;
            $notavail = $row['stocks'] == 0 ? "Not Available" : '';
            $disabled = $row['stocks'] == 0 ? "disabled" : '';
            $opacity = $row['stocks'] == 0 ? "opacity: 0.4" : '';


            $ratesTotal = $menuObj->totalRatingsPerProducts($row['menu_id']);
            $commentsTotal = $menuObj->totalCommentsPerProducts($row['menu_id']);
            $stocks = $row["stocks"];
            echo '
                        <div id="prod" class="col-md-6 card">
                            <div class="card-body">
                                <b>Name</b>:' . $row['title'] . '<br>
                                <b>Price</b>:' . $row['price'] . '<br>
                                <b>Stocks</b>:' . $row['stocks'] . '
                                <img style="width: 100%; height:80%; ' . $opacity . ';" src="' . $row['pic'] . '" class="rounded" />
                                <center><h3 class="text-danger" style="
                                    position: absolute;
                                    top: 40%;
                                    left: 25%;">' . $notavail . '</h3></center>
                            </div>
                            <div class="row card-footer"> 
                                <div class="col-md-3">
                                    <center>
                                        <button ' . $disabled . ' type="button" id="btnMinus' . $a . '" class="btn btn-danger">-</button>
                                    </center>
                                </div>
                                <div class="col-md-6">  
                                <form action="route.php" method="post">
                                    <input ' . $disabled . ' style="text-align:center;" name="qty" required id="input' . $b . '" value="' . (($stocks < 1) ? 0 : 1) . '"  class="form-control nonNegativeInput" type="number" min="0">
                                </div>
                                <div class="col-md-3">
                                    <center>
                                        <button ' . $disabled . ' type="button" id="btnAdd' . $c . '" class="btn btn-primary">+</button>
                                    </center>
                                </div>
                            </div>
                                <center>
                                    <input type="hidden" required name="pic" value="' . $row['pic'] . '">
                                    <input type="hidden" required name="menuId" value="' . $row['menu_id'] . '">
                                    <input type="hidden" required name="categoryId" value="' . $row['cat_id'] . '">
                                    <input type="hidden" required name="UserId" value="' . $regId . '">
                                    <input type="hidden"  required name="AddCart" value="AddCart">
                                    <button ' . $disabled . ' type="submit" class="btn btn-secondary m-3"><i class="fas fa-cart-plus mr-2"> </i>Add Cart</button>
                                </center>
                            </form>
                            <hr>
                            <p class="text-center">
                                Product Ratings <span class="text-danger see-all-reviews" style="cursor:pointer;"  data-id="' . $row['menu_id'] . '">See All</span> <br>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <span class="text-danger">' . $ratesTotal . '</span> (' . $commentsTotal . ' Reviews)
                            </p>
                        </div>

                        <script>
                            let num' . $d . ' = 0;
                            btnMinus' . $a . '.onclick = () => {
                                if(num' . $d . ' != 1) {

                                    document.querySelector("#input' . $b . '").value = --num' . $d . ';
                                }
                            }

                            btnAdd' . $c . '.onclick = () => {
                                document.querySelector("#input' . $b . '").value = ++num' . $d . ';
                                
                                if(' . $row['stocks'] . ' < 1){
                                    alert("The item is currently out of stock with a quantity of ' . $row['stocks'] . '.");
                                    document.querySelector("#input' . $b . '").value=0;
                                }
                                if(document.querySelector("#input' . $b . '").value > ' . $row['stocks'] . ') {
                                    alert("Not enough stock for your order. The available quantity is ' . $row['stocks'] . ' .");
                                    document.querySelector("#input' . $b . '").value=  ' . $row['stocks'] . ';
                                }
                            }
                             document.querySelector("#input' . $b . '").oninput = () => {
                                let inputField = document.querySelector("#input' . $b . '");
                                let inputValue = parseInt(inputField.value, 10);
                                let availableStock = ' . $row['stocks'] . ';

                                if (inputValue > availableStock) {
                                    alert("Not enough stock for your order. The available quantity is " + availableStock + ".");
                                    inputField.value = availableStock;
                                }
                            }

                             

                            document.getElementById("filesearch").addEventListener("keyup", function () {
                                var searchTerm = this.value.toLowerCase();


                                
                                var cards = document.querySelectorAll("#prod");

                                cards.forEach(function (card) {
                                    var cardText = card.textContent.toLowerCase();

                                    if (cardText.indexOf(searchTerm) > -1) {
                                        card.style.display = "";
                                    } else {
                                        card.style.display = "none";
                                    }
                                });
                            });
                        </script>
                        
                    ';

            $a++;
            $b++;
            $c++;
            $d++;
        }
    }

    function showFoodMenu($cat_id)
    {
        global $menuObj;
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;

        $counting = isset($menuObj->getShowMenu($cat_id)[0]) ? $menuObj->getShowMenu($cat_id)[0] : 0;

        if ($counting == 0) {

            echo "<p>Loading...</p>";
        } else {

            foreach ($menuObj->getShowMenu($cat_id) as $row) {

                $regId = isset($_SESSION['reg_id']) ? $_SESSION['reg_id'] : null;
                $notavail = $row['stocks'] == 0 ? "Not Available" : '';
                $disabled = $row['stocks'] == 0 ? "disabled" : '';
                $opacity = $row['stocks'] == 0 ? "opacity: 0.4" : '';
                $ratesTotal = $menuObj->totalRatingsPerProducts($row['menu_id']);
                $commentsTotal = $menuObj->totalCommentsPerProducts($row['menu_id']);
                $stocks = $row["stocks"];

                echo '
                        <div id="prod" class="col-md-6 card">
                            <div class="card-body">
                                <b>Name</b>:' . $row['title'] . '<br>
                                <b>Price</b>:' . $row['price'] . '<br>
                                <b>Stocks</b>:' . $row['stocks'] . '
                                <img style="width: 100%; height:80%; ' . $opacity . ';" src="' . $row['pic'] . '" class="rounded" />
                                <center><h3 class="text-danger" style="
                                    position: absolute;
                                    top: 40%;
                                    left: 25%;">' . $notavail . '</h3></center>
                            </div>
                            <div class="row card-footer"> 
                                <div class="col-md-3">
                                    <center>
                                        <button ' . $disabled . ' type="button" id="btnMinus' . $a . '" class="btn btn-danger">-</button>
                                    </center>
                                </div>
                                <div class="col-md-6">  
                                <form action="route.php" method="post">
                                    <input ' . $disabled . ' style="text-align:center;" name="qty" required id="input' . $b . '" value="' . (($stocks < 1) ? 0 : 1) . '"  class="form-control nonNegativeInput" type="number" min="0">
                                </div>
                                <div class="col-md-3">
                                    <center>
                                        <button ' . $disabled . ' type="button" id="btnAdd' . $c . '" class="btn btn-primary">+</button>
                                    </center>
                                </div>
                            </div>
                                <center>
                                    <input type="hidden" required name="pic" value="' . $row['pic'] . '">
                                    <input type="hidden" required name="menuId" value="' . $row['menu_id'] . '">
                                    <input type="hidden" required name="categoryId" value="' . $row['cat_id'] . '">
                                    <input type="hidden" required name="UserId" value="' . $regId . '">
                                    <input type="hidden"  required name="AddCart" value="AddCart">
                                    <button ' . $disabled . ' type="submit" class="btn btn-secondary m-3"><i class="fas fa-cart-plus mr-2"> </i>Add Cart</button>
                                </center>
                            </form>
                            <hr>
                            <p class="text-center">
                                Product Ratings <span class="text-danger see-all-reviews" style="cursor:pointer;" data-id="' . $row['menu_id'] . '">See All</span> <br>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <i class="fa-solid fa-star" style="color:#FFEB3B"></i>
                                <span class="text-danger">' . $ratesTotal . '</span> (' . $commentsTotal . ' Reviews)
                            </p>
                        </div>

                        <script>
                            let num' . $d . ' = 0;
        
                            btnMinus' . $a . '.onclick = () => {
                                if(num' . $d . ' != 0) {

                                    document.querySelector("#input' . $b . '").value = num' . $d . '--;
                                }
                            }
                            btnAdd' . $c . '.onclick = () => {
                                document.querySelector("#input' . $b . '").value =num' . $d . '++;
                                
                                if(' . $row['stocks'] . ' < 1){
                                    alert("The item is currently out of stock with a quantity of ' . $row['stocks'] . '.");
                                    document.querySelector("#input' . $b . '").value=0;
                                }
                                if(document.querySelector("#input' . $b . '").value > ' . $row['stocks'] . ') {
                                    alert("Not enough stock for your order. The available quantity is ' . $row['stocks'] . ' .");
                                    document.querySelector("#input' . $b . '").value=  ' . $row['stocks'] . ';
                                }
                            }
                             document.querySelector("#input' . $b . '").oninput = () => {
                                let inputField = document.querySelector("#input' . $b . '");
                                let inputValue = parseInt(inputField.value, 10);
                                let availableStock = ' . $row['stocks'] . ';

                                if (inputValue > availableStock) {
                                    alert("Not enough stock for your order. The available quantity is " + availableStock + ".");
                                    inputField.value = availableStock;
                                }
                            }


                            document.getElementById("filesearch").addEventListener("keyup", function () {
                                var searchTerm = this.value.toLowerCase();


                                
                                var cards = document.querySelectorAll("#prod");

                                cards.forEach(function (card) {
                                    var cardText = card.textContent.toLowerCase();

                                    if (cardText.indexOf(searchTerm) > -1) {
                                        card.style.display = "";
                                    } else {
                                        card.style.display = "none";
                                    }
                                });
                            });
                        </script>
                    ';

                $a++;
                $b++;
                $c++;
                $d++;
            }
        }
    }

    function getAdminProfile($adminId)
    {
        global $loginObj;

        return $loginObj->getAdminProfile(
            $adminId
        );
    }

    function url($icon, $msg, $path)
    {
        echo '
                <script>
                    Swal.fire({
                        position: "center",
                        icon: "' . $icon . '",
                        title: "' . $msg . '",
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
            ';

        echo '
                <script>
                    setTimeout(() => {
                        window.location="' . $path . '";
                    }, 2000);
                </script>
            ';
    }
    function url2($icon, $msg, $path)
    {
        // echo '
        //         <script>
        //             Swal.fire({
        //                 position: "center",
        //                 icon: "' . $icon . '",
        //                 title: "' . $msg . '",
        //                 showConfirmButton: false,
        //                 timer: 2000
        //             });
        //         </script>
        //     ';
    
        echo '
                <script>
                    setTimeout(() => {
                        window.location="' . $path . '";
                    });
                </script>
            ';


    }
    function getFoodCategory()
    {
        global $catObj;

        foreach ($catObj->getFoodCategory() as $row) {
            echo "
                    <tr>
                        <td>$row[cat_id]</td>
                        <td>$row[cat_title]</td>
                        <td>
                            <center>
                                <button onclick=removeFoodCategory(" . $row['cat_id'] . ") class='btn btn-danger'> <i class='fas fa-trash'></i> Remove</button>
                                <button onclick='prepareUpdate({$row['cat_id']}, \"{$row['cat_title']}\") ' class='btn btn-warning'> <i class='far fa-edit'></i> Edit</button>
                            </center>
                        </td>
                    </tr>
                ";
        }


    }

    function getReviewGlobal()
    {
        global $reviewObj;

        foreach ($reviewObj->getReview() as $row) {

            echo "<hr><p class='lead'>$row[review] - $row[rates]</p>";
            echo "<p class='lead'>$row[comment]</p>";
            echo "<i class='lead'> - $row[name]</i><hr>";
        }
    }

    function getReview()
    {
        global $reviewObj;

        foreach ($reviewObj->getReview() as $row) {
            $orderDate = $row['raviews_date'];

            $date = new DateTime($orderDate);

            $date = $date->format('F j, Y');

            echo "
                    <tr>
                        <td>$row[rate_id]</td>
                        <td>$row[fname] $row[lname]</td>
                        <td>$row[title]</td>
                        <td>$row[cat_title]</td>
                        <td>$row[product_quality]</td>
                        <td>$row[seller_service]</td>
                        <td>$row[delivery_speed]</td>
                        <td>$row[message]</td>
                        <td>$date</td>
                        <td>
                            <center>
                                <button onclick=removeReview(" . $row['rate_id'] . ") class='btn btn-danger'> <i class='fas fa-trash'></i> Remove</button>
                            </center>
                        </td>
                    </tr>
                ";
        }
    }

    function getGallery()
    {
        global $galleryObj;

        foreach ($galleryObj->getGallery() as $row) {
            echo "
                    <tr>
                        <td>$row[gallery_id]</td>
                        <td><center><img src='$row[images]' width='60' height='50' style='border-radius: 50%;'/></center> 
                        </td>
                        <td>
                            <center>
                                <button onclick=removeGallery(" . $row['gallery_id'] . ") class='btn btn-danger'> <i class='fas fa-minus'></i> Remove</button>
                            </center>
                        </td>
                    </tr>
                ";
        }
    }

    function getDpCategory()
    {
        global $menuObj;

        foreach ($menuObj->getDpCategory() as $row) {
            echo "
                    <option value=" . $row['cat_id'] . ">$row[cat_title]</option>
                ";
        }
    }

    function getFoodMenu()
    {
        global $menuObj;

        foreach ($menuObj->getFoodMenu() as $row) {
            echo "
                    <tr>
                        <td>$row[menu_id]</td>
                        <td><center><img src='$row[pic]' width='40' height='40' style='border-radius: 50%;' /></center> </td>
                        <td>$row[cat_title]</td>
                        <td>$row[title]</td>
                        <td>$row[description]</td>
                        <td>$row[price]</td>
                        <td>$row[stocks]</td>
                        <td>
                            <center>
                                <button onclick=removeFoodMenu(" . $row['menu_id'] . ") class='btn btn-danger btn-sm w-100 mb-2'> <span class='fas fa-trash'></span>Remove</button>
                                <button onclick='prepareUpdateProd({$row['menu_id']},\"{$row['pic']}\", \"{$row['cat_id']}\", \"{$row['title']}\", \"{$row['description']}\", \"{$row['price']}\", \"{$row['stocks']}\") ' class='btn btn-warning btn-sm w-100 mb-2'> <span class='far fa-edit'></span> Edit</button>
                            </center>
                        </td>
                    </tr>
                ";
        }
    }

    function totalParcel()
    {
        global $tileObj;

        return $tileObj->totalParcel();
    }

    function totalMenu()
    {
        global $tileObj;

        return $tileObj->totalMenu();
    }

    function totalGallery()
    {
        global $tileObj;

        return $tileObj->totalGallery();
    }

    function totalReviews()
    {
        global $tileObj;

        return $tileObj->totalReviews();
    }

    function totalCategory()
    {
        global $tileObj;

        return $tileObj->totalCategory();
    }

    function getParcelClients()
    {
        global $parcelObj;


        foreach ($parcelObj->getParcelClients() as $row) {
            $orderDate = $row['order_date'];

            $date = new DateTime($orderDate);

            $date = $date->format('F j, Y');

            echo "
                    <tr>
                        <td>$row[menu_id]</td>
                        <td>$row[userCode]</td>
                        <td>$row[fname] $row[m_name] $row[lname]</td>
                        <td>$date</td>
                        <td>
                        <a href='viewParcel.php?userId={$row['reg_id']}&checkoutId={$row['checkout_id']}' style='color: white;' class='btn btn-primary'> <i class='fas fa-eye'></i> View</a>
                        </td>
                    </tr>
                ";
        }
    }

    function getNotifications()
    {
        global $parcelObj;


        $notifications = $parcelObj->getNotifications();
        $rowCount = count($notifications);
        if ($rowCount === 0) {
            echo "";
        } else {

            echo $rowCount;
        }

    }

    function getNotificationContent()
    {
        global $parcelObj;
        $notifContent = $parcelObj->getNotificationContent();
        $rowCount = count($notifContent);

        if ($rowCount === 0) {
            echo '<a class="dropdown-item" href="#">No notifications</a>';
        } else {
            foreach ($notifContent as $row) {
                // Determine the background color based on the 'active' status
                $bgColor = ($row['active'] == 2) ? 'background-color: lightgray;' : 'background-color: white;';

                $ckid = $row['checkout_id'];

                // echo '<a class="dropdown-item" href="viewParcelClient.php?userId=' . urlencode($row["reg_id"]) . '&checkoutId=' . urlencode($row["checkout_id"]) . '" style="' . $bgColor . '" onclick="alert(\'' . updateNotif($ckid) . '\'); return true;">'
                //     . 'Your order was delivered. <strong style="color: blue;">View Order</strong></a>';
                echo '<a class="dropdown-item" href="viewParcelClient.php?userId=' . urlencode($row["reg_id"]) . '&checkoutId=' . urlencode($row["checkout_id"]) . '&action=2" style="' . $bgColor . '" ); return true;">'
                    . 'Your order was delivered. <strong style="color: blue;">View Order</strong></a>';


            }
        }
    }

    if (isset($_GET['action']) && isset($_GET['checkoutId']) && isset($_GET['userId'])) {

        // echo "<script>alert('Attention: This is your alert message!');</script>";
        global $parcelObj;
        $parcelObj->updateNotif($_GET['checkoutId']);
    }
    function updateNotif($ckid)
    {
        global $parcelObj;
        $parcelObj->updateNotif($ckid);
    }



    function viewClientOrders()
    {
        global $parcelObj;

        $reg_id = $_SESSION['reg_id'];
        $status = '';


        foreach ($parcelObj->getClientOrderList($reg_id) as $row) {

            $orderDate = $row['order_date'];

            $date = new DateTime($orderDate);

            $date = $date->format('F j, Y');

            $checkoutIdd = $row['checkout_id'];

            if ($row['status_order'] == 0) {
                $status = '<span class="badge bg-warning text-white">TO PAY</span>'; //0
            } else if ($row['status_order'] == 1) {
                $status = '<span class="badge bg-secondary text-white">CASH ON DELIVERY</span>'; //2
            } else if ($row['status_order'] == 2) {
                $status = '<span class="badge bg-primary text-white">SHIPPED</span>'; //2
            } else {
                $status = '<span class="badge bg-success text-white">RECIEVED</span>'; //3
            }

            echo "
            <tr>
                <td>{$row['fname']} {$row['m_name']} {$row['lname']}</td>
                <td>$date</td>
                <td>{$row['payment_method']}</td>
                <td>$status</td>
                <td>
                    <a href='viewParcelClient.php?userId={$row['reg_id']}&checkoutId={$row['checkout_id']}' style='color: white;' class='btn btn-primary'>
                        <i class='fas fa-eye'></i> View
                    </a>
                </td>
            </tr>
        ";
        }
    }

    if (isset($_GET['statusVP']) && isset($_GET['ckid']) && isset($_GET['userId'])) {
        $parcelObj->updateStatus($_GET['statusVP'], $_GET['ckid']);

        $url = 'viewParcel.php?userId=' . urlencode($_GET['userId']) . '&checkoutId=' . urlencode($_GET['ckid']);

        url2('success', 'Success update Status.', $url);
    }


    function viewParcelClients($regId, $checkoutId)
    {
        global $parcelObj;
        $totalprice = 0;
        $totalquant = 0;
        $result = $parcelObj->viewParcelClients($regId, $checkoutId);
        $orderDate = $result[0]['order_date'];

        $date = new DateTime($orderDate);

        $date = $date->format('F j, Y');

        if ($result[0]['order_date'] == 0) {
            $selected = 'selected';
        } else if ($result[0]['order_date'] == 1) {
        } else if ($result[0]['order_date'] == 2) {
            $selected = 'selected';
        } else {
            $selected = 'selected';
        }

        $typ_btn0 = 'light';
        $typ_btn1 = 'light';
        $typ_btn2 = 'light';
        $typ_btn3 = 'light';

        if (isset($result[0]['status_order']) && $result[0]['status_order'] == 0) {
            $typ_btn0 = 'warning';
        } else if (isset($result[0]['status_order']) && $result[0]['status_order'] == 1) {
            $typ_btn1 = 'secondary';
        } else if (isset($result[0]['status_order']) && $result[0]['status_order'] == 2) {
            $typ_btn2 = 'primary';
        } else if (isset($result[0]['status_order']) && $result[0]['status_order'] == 3) {
            $typ_btn3 = 'success';
        }

        if ($result[0]['status_order'] == 0) {
            $status = '<span class="badge bg-warning text-white">TO PAY</span>'; //0
        } else if ($result[0]['status_order'] == 1) {
            $status = '<span class="badge bg-secondary text-white">CASH ON DELIVERY</span>'; //2
        } else if ($result[0]['status_order'] == 2) {
            $status = '<span class="badge bg-primary text-white">SHIPPED</span>'; //2
        } else {
            $status = '<span class="badge bg-success text-white">RECIEVED</span>'; //3
        }
        $ckid = $result[0]['checkout_id'];
        echo "
                <table class='table table-bordered'>
                    <tr>
                        <th colspan='2'><center>Customer Details</center></th>
                    </tr>
                    <tr>
                        <th>Customer Name: </th>
                        <td>" . $result[0]['fname'] . " " . $result[0]['lname'] . "</td>
                    </tr>
                    <tr>
                    
                    <th>Order Date: </th>
                        <td>" . $date . "</td>
                    </tr>
                    <th>Status: </th>
                        <td>
                            <a class='btn btn-" . $typ_btn0 . "' href='viewParcel.php?userId=" . $_GET['userId'] . "&statusVP=0&ckid=" . $result[0]['checkout_id'] . "'>TO PAY</a>

                            <a class='btn btn-" . $typ_btn2 . "' href='viewParcel.php?userId=" . $_GET['userId'] . "&statusVP=2&ckid=" . $result[0]['checkout_id'] . "'>SHIPPED</a>

                            <a class='btn btn-" . $typ_btn3 . "' onclick='addDelivery( $ckid)' >RECIEVED</a>
                        </td>
                    </tr>
                    <th>Payment Method: </th>
                        <td>" . $result[0]['payment_method'] . "</td>
                    </tr>  
                    <th>Proof of Payment: </th>
                        <td><a class='btn btn-primary' target='_blank' href='" . $result[0]['proof_gcpayment'] . "'>View</a></td>
                    </tr>  
                    <tr>
                </table>

                <table class='table table-bordered'>
                <tr>
                    <th colspan='5'><center>Order List</center></th>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            ";

        $alltotal = 0;
        $finalTotal = 0;
        $totalquant = 0;

        foreach ($result as $row) {
            $totalquant += $row['checkout_Qty'];

            $finalTotal = $row['price'] * $row['checkout_Qty'];

            $alltotal += $finalTotal;

            echo "
                        <tr>
                            <td>$row[title]</td>
                            <td>$row[description]</td>
                            <td>$row[cat_title]</td>
                            <td>$row[checkout_Qty]</td>
                            <td>&#8369;$row[price]</td>
                            <td>$finalTotal</td>
                        </tr>
                    ";
        }

        echo "
                    <tr>
                        <th>Total Quantity: </th>
                        <td colspan='5' style='color:red'><b>" . $totalquant . "</b></td>
                    </tr>
                    <tr>
                        <th>Total Price: </th>
                        <td colspan='5' style='color:red'><b>&#8369; " . $alltotal . "</b></td>
                    </tr>
                    
                </table>
                ";
    }


    function viewParcelClientsUser($regId, $checkoutId)
    {
        global $parcelObj;
        $totalprice = 0;
        $totalquant = 0;
        $result = $parcelObj->viewParcelClients($regId, $checkoutId);

        $orderDate = $result[0]['order_date'];

        $date = new DateTime($orderDate);

        $date = $date->format('F j, Y');
        if ($result[0]['order_date'] == 0) {
            $selected = 'selected';
        } else if ($result[0]['order_date'] == 1) {
        } else if ($result[0]['order_date'] == 2) {
            $selected = 'selected';
        } else {
            $selected = 'selected';
        }
        $status_of_order = $result[0]['status_order'];

        if ($status_of_order == 0) {
            $status = '<span class="badge bg-warning text-white">TO PAY</span>'; //0
        } else if ($status_of_order == 1) {
            $status = '<span class="badge bg-secondary text-white">CASH ON DELIVERY</span>'; //2
        } else if ($status_of_order == 2) {
            $status = '<span class="badge bg-primary text-white">SHIPPED</span>'; //2
        } else {
            $status = '<span class="badge bg-success text-white">RECIEVED</span>'; //3
        }
        echo "
            <table class='table table-bordered'>
                <tr>
                    <th colspan='2'><center>Customer Details</center></th>
                </tr>
                <tr>
                    <th>Customer Name: </th>
                    <td>" . $result[0]['fname'] . " " . $result[0]['m_name'] . " " . $result[0]['lname'] . "</td>
                </tr>
                <tr>
                    <th>Order Date: </th>
                    <td>" . $date . "</td>
                </tr>
                <tr>
                    <th>Status: </th>
                    <td>$status</td>
                </tr>
                <tr>
                    <th>Payment Method: </th>
                    <td>" . htmlspecialchars($result[0]['payment_method']) . "</td>
                </tr>
        ";

        // Check the status of the order
        if ($status_of_order == 3) {
            echo "
                <tr>
                    <th>Proof of Delivery:</th>
                    <td>
                        <img src='" . htmlspecialchars($result[0]['proof_of_delivery']) . "' alt='Proof of Delivery' style='width: max; height: 300px;'>
                    </td>
                </tr>
            ";
        }

        echo "
                <!-- <th>Proof of Payment: </th>
                    <td><a class='btn btn-primary' target='_blank' href='" . $result[0]['proof_gcpayment'] . "'>View</a></td>
                </tr>  
                <tr>
                --!>
            </table>

            <table class='table table-bordered'>
                <tr>
                    <th colspan='5'><center>Order List</center></th>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
        ";


        $alltotal = 0;
        $finalTotal = 0;
        $totalquant = 0;

        foreach ($result as $row) {
            $totalquant += $row['checkout_Qty'];

            $finalTotal = $row['price'] * $row['checkout_Qty'];

            $alltotal += $finalTotal;

            echo "
                    <tr>
                        <td>$row[title]</td>
                        <td>$row[description]</td>
                        <td>$row[cat_title]</td>
                        <td>$row[checkout_Qty]</td>
                        <td>&#8369;$row[price]</td>
                        <td>$finalTotal</td>
                    </tr>
                ";
        }

        echo "
                <tr>
                    <th>Total Quantity: </th>
                    <td colspan='5' style='color:red'><b>" . $totalquant . "</b></td>
                </tr>
                <tr>
                    <th>Total Price: </th>
                    <td colspan='5' style='color:red'><b>&#8369; " . $alltotal . "</b></td>
                </tr>
                
            </table>

                           
            
            ";
        if ($result[0]['status_order'] == 3) {
            echo "
                    <a href='#' class='btn btn-info mt-2'>
                        <i class='fas fa-print'></i> Print Receipt
                    </a>
                ";
        }

    }

    ?>

</body>

<!-- <tr>
                    <th>Total Due: </th>
                    <td colspan='4' style='color:red'><b>&#8369; " . ($totalprice * $totalquant) . "</b></td>
                </tr> -->

</html>