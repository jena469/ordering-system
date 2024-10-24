<div class="modal fade" id="addFoodMenu" tabindex="-1" aria-labelledby="addFoodMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Food Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="route.php" method="post" enctype="multipart/form-data" id="prod_form">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Upload Image:</label>
                                <input type="file" required name="file" id="pic" class="form-control">
                                <!-- <small id="pic-info" class="form-text text-muted">No file selected</small> -->
                                <input type="hidden" name="AddFoodMenu" value="AddFoodMenu">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Food Category:</label>
                                <select name="cat_id" id="cat_id" required class="form-control">
                                    <option disabled>Select Category</option>
                                    <?php getDpCategory(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Product Name:</label>
                                <input type="text" required name="title" id="title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea required class="form-control" name="desc" id="desc" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Price:</label>
                                <input type="text" id="price" required name="price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Stocks:</label>
                                <input type="number" required name="stocks" id="stocks" class="form-control" min="0" oninput="checkInput(event)">
                                <div id="stocks-error" style="color: red;"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="menu_id" name="menu_id">
                <input type="hidden" id="submit_btn" name="AddFood">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function checkInput(event) {
        const stocksInput = event.target.value;
        const stocksError = document.getElementById('stocks-error');

        if (stocksInput === "-1") {
            stocksError.textContent = "Invalid input. Please enter a positive integer.";
            event.target.setCustomValidity("Invalid input. Please enter a positive integer.");
        } else {
            stocksError.textContent = "";
            event.target.setCustomValidity("");
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');

    priceInput.addEventListener('input', function(e) {
        // Remove any non-numeric and non-decimal characters
        this.value = this.value.replace(/[^0-9.]/g, '');

        // Remove multiple decimal points
        const parts = this.value.split('.');
        if (parts.length > 2) {
            this.value = parts[0] + '.' + parts.slice(1).join('');
        }
    });
});

</script>