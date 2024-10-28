<?php include('route.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('header.php'); ?>
    <title>Home | Page</title>
    <style>
    .col-md-6.card {
        max-width: 352px;
        margin-bottom: 23px;
    }

    .row {
        justify-content: space-around;
    }

		.overflo-box {
			overflow-x: hidden;
			max-height: 86vh;
		}

    .card.box-h {
        height: 100vh;
    }

    .card-body.box-h {
        height: 708px;
    }

    img.rounded {
        height: 233px !important;
    }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mb-5">
        <div class="card shadow">
            <div class="card-body ">
                <center>
                    <h1>Order Now</h1>

                </center>
                <div class="row">
                    <div class="col-sm-3" style="padding: 2%;">
                        <div class="card box-h">
                            <div class="card-header">
                                <p>Category</p>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="landingpage.php">All</a></li>
                                    <?php showCategory(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="padding: 2%;">
                        <div class="card">
                            <div class="card-header">
                                <p>Product List</p>

                            </div>
                            <div class="px-2">
                                <input class="form-control mr-sm-2 my-2" type="search" placeholder="Search"
                                    aria-label="Search" id="filesearch">
                            </div>
                            <div class="card-body box-h">
                                <div class="row overflo-box">
                                    <?php

									if (empty($_GET['catId'])) {
										showAllMenu();
									} else {
										showFoodMenu(isset($_GET['catId']) ? $_GET['catId'] : '<center>Empty menu list...</center>');
									}

									?>
                                </div>

                            </div>

                        </div>
                        <div id="pagination" class="mt-1 d-flex justify-content-center "></div>


                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // $("#filesearch").keyup(function () {
        //     var searchTerm = $(this).val().toLowerCase();

        //     $('.card').each(function() {
        //         var cardText = $(this).text().toLowerCase();

        //         if (cardText.indexOf(searchTerm) > -1) {
        //             $(this).show();
        //         } else {
        //             $(this).hide();
        //         }
        //     });
        // });
        var inputs = document.querySelectorAll('.nonNegativeInput');
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = '';
                }
            });
        });
    });

    $('.see-all-reviews').on('click', function() {
        let dataID = $(this).data('id');
        $('#reviewsModal').modal('show')
        $('#product_id').val(dataID);

        const showlist = async (menuid) => {

            let response = await fetch(`route.php?list_reviews=list_reviews&menu_id=${menuid}`, {
                credentials: "same-origin",
                method: 'GET'
            });

            let {
                message,
                status
            } = await response.json();

            if (status == 'success') {
                let list = '';
                message.forEach(el => {
                    list += `
							<li>
								<span>${el.fname} ${el.lname}</span>
								<p>
									${el.message}
								</p>
							</li>
						`;
                })

                document.querySelector('#list_reviews').innerHTML = list != '' ? list :
                    '<li>No reviews.</i>';
            } else {
                console.log(message);
            }
        }

        showlist(dataID);



    });
    </script>
    <?php include('Modal/reviews_Modal.php');
	include('footer.php'); ?>
</body>

</html>