<div class="modal fade" id="placeOrderModal" tabindex="-1" aria-labelledby="placeOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="placeorder" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div id="gcashQr" class="form-group">
                                <center>
                                    <img src="https://businessmaker-academy.com/cms/wp-content/uploads/2022/04/Gcash-BMA-QRcode.jpg" width="300" height="400">
                                </center>
                                <div class="form-group">
                                    <label>Proof of Payment:</label>
                                    <input type="file" id="gcashReciept" name="gcashReciept" class="form-control">
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        let fileInput = document.querySelector('#gcashReciept');
                                        
                                        fileInput.addEventListener('change', function() {
                                            if (fileInput.files.length > 0) {
                                                $('.forms-input').show();
                                                $('#gcashQr').hide();
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="forms-input">
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" readonly value="<?= $_SESSION['customerName'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number:</label>
                                    <input type="number" required name="phonenum" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Address:</label>
                                    <textarea name="address" cols="20" rows="3" class="form-control"></textarea>
                                    <input type="hidden" name="paymenttype" id="paymenttype">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="CheckOut" value="CheckOut">
                        <button type="submit" class="btn btn-success">Order Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    placeorder.onsubmit = async (e) => {
        e.preventDefault();

        let cf = confirm("Confirm to complete orders?");

        if (cf) {
            let response = await fetch('route.php', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(placeorder)
            });

            let {
                message,
                status
            } = await response.json();

            if (status == 'success') {
                alert(message);
                setTimeout(() => {
                    window.location="reciept.php";
                }, 1000);
            } else {
                console.log(message);
            }
        }
    };
</script>