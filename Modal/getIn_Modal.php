<div class="modal fade" id="placeOrderModal" tabindex="-1" aria-labelledby="placeOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Place Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="placeorder(event)" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div id="gcashQr" class="form-group text-center">
                                <?php
                                require "./connection/index.php";
                                $sql = "SELECT * FROM bank ORDER BY id DESC";
                                $result = $conn->query($sql);
                                $paymentMethods = [];

                                while ($row = $result->fetch_assoc()) {
                                    $paymentMethods[] = $row;
                                }
                                ?>

                                <div id="paymentMethodContainer">

                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" id="prevPayment" class="btn btn-secondary">Previous</button>
                                    <button type="button" id="nextPayment" class="btn btn-secondary">Next</button>
                                </div>

                                <div class="form-group mt-4">
                                    <label>Proof of Payment:</label>
                                    <input type="file" id="gcashReciept" name="gcashReciept" class="form-control">
                                </div>
                            </div>

                            <div class="forms-input mt-3">
                                <div class="form-group">
                                    <label>Full Name:</label>
                                    <input type="text" readonly value="<?= $_SESSION['customerName'] ?>"
                                        class="form-control">
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const placeorder = async (event) => {
        event.preventDefault();

        const {
            value: willProceed = false
        } = await Swal.fire({
            title: 'Confirm to complete orders?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel'
        });

        if (willProceed) {
            try {
                let response = await fetch('route.php', {
                    credentials: "same-origin",
                    method: 'POST',
                    body: new FormData(event.target)
                });
                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();
                let {
                    message,
                    status
                } = data;

                if (status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(() => window.location = "reciept.php", 1500);
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: message,
                        icon: 'error'
                    });
                }
            } catch (error) {
                console.error('Parse error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again later.',
                    icon: 'error'
                });
            }
        }
    };

    // JavaScript to handle payment method carousel
    let paymentMethods = <?= json_encode($paymentMethods) ?>;
    let currentPaymentIndex = 0;

    function displayPaymentMethod(index) {
        const container = document.getElementById("paymentMethodContainer");
        if (paymentMethods.length > 0) {
            const {
                bankName,
                accountNumber,
                name,
                image
            } = paymentMethods[index];
            container.innerHTML = `
                <div class="text-center">
                    <h6 class='mb-0'><strong>${bankName}</strong></h6>
                    <p class='mb-0 text-dark'>Account Number: ${accountNumber}</p>
                    <p class='mb-0 text-dark'>Name: ${name}</p>
                    <img src="${image}" class="img-fluid" alt="${bankName} QR Code" style="max-width: 250px;">
                </div>
            `;
        }
    }

    document.getElementById("prevPayment").addEventListener("click", () => {
        if (currentPaymentIndex > 0) {
            currentPaymentIndex--;
            displayPaymentMethod(currentPaymentIndex);
        }
    });

    document.getElementById("nextPayment").addEventListener("click", () => {
        if (currentPaymentIndex < paymentMethods.length - 1) {
            currentPaymentIndex++;
            displayPaymentMethod(currentPaymentIndex);
        }
    });

    // Initial display of the first payment method
    displayPaymentMethod(currentPaymentIndex);
</script>