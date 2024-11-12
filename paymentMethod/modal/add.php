<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="modal fade bd-example-modal-lg" id="addBank" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBankForm">
                    <div class="row">
                        <div class="col">
                            <label for="name">Bank Name</label>
                            <select class="form-control" id="nameBank" name="nameBank" required>
                                <option value="" disabled selected>Select Bank Name</option>
                                <option value="GCASH">GCASH</option>
                                <option value="MAYA">MAYA</option>
                                <option value="UNION BANK">UNION BANK</option>
                                <option value="BDO">BDO</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="accountNumber">Account Number</label>
                            <input type="number" class="form-control" id="accountNumber" placeholder="Account Number"
                                name="accountNumber" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="ownerName">Name of the owner</label>
                            <input type="text" class="form-control" id="ownerName" placeholder="Owner Name"
                                name="ownerName" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="qr">Upload QR Code</label>
                            <img id="image" src="img/default.jpg"
                                style="margin-left: 65px; padding: 0; width: 100px;" />
                            <br>
                            <input style="margin-left: 75px;" class="form-control-file" name="file" accept="image/*"
                                type="file" id="qr" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('qr').onchange = function () {
        var input = this;
        if (input.files.length) {
            document.getElementById("image").setAttribute("src", URL.createObjectURL(input.files[0]));
        }
    }

    document.getElementById('addBankForm').addEventListener('submit', function (event) {
        event.preventDefault();

        var nameBank = document.getElementById('nameBank').value;
        var accountNumber = document.getElementById('accountNumber').value;
        var ownerName = document.getElementById('ownerName').value;

        if (!Number(accountNumber)) {
            toastr.error('Please enter a valid number.');
            return;
        } else if (nameBank.trim() === '' || accountNumber.trim() === '' || ownerName.trim() === '') {
            toastr.error('Please fill in all fields.');
            return;
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to add this bank?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm(event);
                }
            });
        }
    });

    function submitForm(event) {
        event.preventDefault();
        var formData = new FormData(document.getElementById('addBankForm'));

        $('#addBank').modal('hide');
        $('#loadingModal').modal('show')
        $('#loadingModal').on('hide.bs.modal', function (e) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
        fetch('./paymentMethod/process/add.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $('#loadingModal').modal('hide');
                if (data.status === '200') {
                    toastr.success('Payment method has been successfully inserted.', {
                        timeOut: 2000,
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        preventDuplicates: true,
                        newestOnTop: true
                    });
                    var modalElement = document.getElementById('addBank');
                    var modalInstance = bootstrap.Modal.getInstance(modalElement);
                    modalInstance.hide();
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else {
                    toastr.error('Error occurred during the insertion.');
                }
            })
            .catch(error => {
                toastr.error('An error occurred while processing the request.');
            });
    }
</script>