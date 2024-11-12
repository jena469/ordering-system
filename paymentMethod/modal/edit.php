<!-- Modal -->
<div class="modal fade" id="editBankDetails" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editItemModalLabel">Edit Bank Details</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="editBankForm" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <input type="hidden" id='id' name="id">
                        <div class="col">
                            <label for="mode" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" id="mode" name="mode" required>
                        </div>
                        <div class="col">
                            <label for="accountNum" class="form-label">Account Number</label>
                            <input type="number" class="form-control" id="accountNum" name="accountNum" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Owner Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="editImgs" class="form-label">Upload QR Code</label>
                            <img id="images" alt="No image shown" class="d-block mb-2"
                                style="margin-left: 65px; padding: 0; width: 100px;" />
                            <input class="form-control" name="editImgs" accept="image/*" type="file" id="editImgs" />
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('editImgs').onchange = function () {
        var input = this;
        if (input.files.length) {
            document.getElementById("images").setAttribute("src", URL.createObjectURL(input.files[0]));
        }
    }

    document.getElementById('editBankForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        handleSubmit(); // Call handleSubmit function
    });

    function handleSubmit() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save these changes?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = document.getElementById('id').value;
                var mode = document.getElementById('mode').value;
                var accountNum = document.getElementById('accountNum').value;
                var name = document.getElementById('name').value;
                var editImgs = document.getElementById('editImgs').files[0];

                var formData = new FormData();
                formData.append('id', id);
                formData.append('mode', mode);
                formData.append('accountNum', accountNum);
                formData.append('name', name);
                formData.append('editImgs', editImgs);
                $('#editBankDetails').modal('hide');
                $('#loadingModal').modal('show')
                $('#loadingModal').on('hide.bs.modal', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                });
                fetch('./paymentMethod/process/update.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        $('#loadingModal').modal('hide')
                        if (response.ok) {
                            toastr.success('Your record has been updated successfully!', 'Update Successful', {
                                timeOut: 3000,
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right',
                                preventDuplicates: true,
                                newestOnTop: true
                            });
                            var modalElement = document.getElementById('editBankDetails');
                            var modalInstance = bootstrap.Modal.getInstance(modalElement);
                            modalInstance.hide();
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                        } else {
                            toastr.error('An error occurred while updating the record.', 'Error', {
                                timeOut: 5000,
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right',
                                preventDuplicates: true,
                                newestOnTop: true
                            });
                        }
                    })
                    .catch(error => {
                        toastr.error('An error occurred while updating the record.', 'Error', {
                            timeOut: 5000,
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            preventDuplicates: true,
                            newestOnTop: true
                        });
                        console.error('Error:', error);
                    });
            }
        })
    }
</script>