<div class="modal fade" id="addDeliveryProof" tabindex="-1" aria-labelledby="addDeliveryProof" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deliver Proof</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="route.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Upload Proof of Delivery:</label>
                    <input type="file" required name="file" id="proof_of_delivery" class="form-control">
                    <input type="hidden" name="updateProof" value="updateProof">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="checkout_id" name="checkout_id">

        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>