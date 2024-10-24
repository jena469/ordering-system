<style>
    i.fa-regular.fa-star {
        font-size: 20px;
        color: #f69f3d;
    }
</style>
<div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="reviewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reviews</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Review List</h3>
                <hr>
                <ul 
                style="
                    max-height: 200px;
                    overflow-x: hidden;
                    overflow-y: scroll;
                " id="list_reviews">
                </ul>
            </div>
            <?php if (isset($_SESSION['reg_id']) && $_SESSION['reg_id'] != '') : ?>
                <div class="card-footer text-center">
                    <form action="route.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Product Quality
                            </div>
                            <div class="col-md-4">
                                <i class="fa-regular fa-star pq_rate" data-rating="1"></i>
                                <i class="fa-regular fa-star pq_rate" data-rating="2"></i>
                                <i class="fa-regular fa-star pq_rate" data-rating="3"></i>
                                <i class="fa-regular fa-star pq_rate" data-rating="4"></i>
                                <i class="fa-regular fa-star pq_rate" data-rating="5"></i>
                            </div>
                            <div class="col-md-4">
                                <span class="rateStatusPQ">...</span>
                                <input type="hidden" name="produc_quality" id="product_quality" value="0" required>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.pq_rate').click(function() {
                                        var rating = $(this).data('rating');
                                        updateStars(rating);
                                        $('#product_quality').val(rating)
                                        var statusText = getStatusText(rating);
                                        $('.rateStatusPQ').text(statusText);
                                    });

                                    function updateStars(rating) {
                                        // Remove solid class from all stars
                                        $('.pq_rate').removeClass('fas').addClass('far');

                                        // Add solid class to stars up to the selected rating
                                        $('.pq_rate').each(function() {
                                            if ($(this).data('rating') <= rating) {
                                                $(this).removeClass('far').addClass('fas');
                                            }
                                        });
                                    }

                                    function getStatusText(rating) {
                                        switch (rating) {
                                            case 1:
                                                return 'Terrible';
                                            case 2:
                                                return 'Poor';
                                            case 3:
                                                return 'Fair';
                                            case 4:
                                                return 'Good';
                                            case 5:
                                                return 'Amazing';
                                            default:
                                                return 'Click a star to rate:';
                                        }
                                    }
                                });
                            </script>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-4">
                                Seller Service
                            </div>
                            <div class="col-md-4">
                                <i class="fa-regular fa-star ss_rate" data-rating="1"></i>
                                <i class="fa-regular fa-star ss_rate" data-rating="2"></i>
                                <i class="fa-regular fa-star ss_rate" data-rating="3"></i>
                                <i class="fa-regular fa-star ss_rate" data-rating="4"></i>
                                <i class="fa-regular fa-star ss_rate" data-rating="5"></i>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="seller_service" id="seller_service" value="0" required>
                                <span class="rateStatusSS">...</span>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.ss_rate').click(function() {
                                        var rating = $(this).data('rating');
                                        updateStars(rating);
                                        $('#seller_service').val(rating)
                                        var statusText = getStatusTextSS(rating);
                                        $('.rateStatusSS').text(statusText);
                                    });

                                    function updateStars(rating) {
                                        // Remove solid class from all stars
                                        $('.ss_rate').removeClass('fas').addClass('far');

                                        // Add solid class to stars up to the selected rating
                                        $('.ss_rate').each(function() {
                                            if ($(this).data('rating') <= rating) {
                                                $(this).removeClass('far').addClass('fas');
                                            }
                                        });
                                    }

                                    function getStatusTextSS(rating) {
                                        switch (rating) {
                                            case 1:
                                                return 'Terrible';
                                            case 2:
                                                return 'Poor';
                                            case 3:
                                                return 'Fair';
                                            case 4:
                                                return 'Good';
                                            case 5:
                                                return 'Amazing';
                                            default:
                                                return 'Click a star to rate:';
                                        }
                                    }
                                });
                            </script>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                Delivery Speed
                            </div>
                            <div class="col-md-4">
                                <i class="fa-regular fa-star ds_rate" data-rating="1"></i>
                                <i class="fa-regular fa-star ds_rate" data-rating="2"></i>
                                <i class="fa-regular fa-star ds_rate" data-rating="3"></i>
                                <i class="fa-regular fa-star ds_rate" data-rating="4"></i>
                                <i class="fa-regular fa-star ds_rate" data-rating="5"></i>
                            </div>
                            <div class="col-md-4">
                                <span class="rateStatusDS">...</span>
                                <input type="hidden" name="delivery_speed" id="delivery_speed" value="0" required>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.ds_rate').click(function() {
                                        var rating = $(this).data('rating');
                                        updateStars(rating);
                                        $('#delivery_speed').val(rating)
                                        var statusText = getStatusTextDS(rating);
                                        $('.rateStatusDS').text(statusText);
                                    });

                                    function updateStars(rating) {
                                        // Remove solid class from all stars
                                        $('.ds_rate').removeClass('fas').addClass('far');

                                        // Add solid class to stars up to the selected rating
                                        $('.ds_rate').each(function() {
                                            if ($(this).data('rating') <= rating) {
                                                $(this).removeClass('far').addClass('fas');
                                            }
                                        });
                                    }

                                    function getStatusTextDS(rating) {
                                        switch (rating) {
                                            case 1:
                                                return 'Terrible';
                                            case 2:
                                                return 'Poor';
                                            case 3:
                                                return 'Fair';
                                            case 4:
                                                return 'Good';
                                            case 5:
                                                return 'Amazing';
                                            default:
                                                return 'Click a star to rate:';
                                        }
                                    }
                                });
                            </script>
                        </div>

                        <hr>
                        <div class="row p-2">
                            <div class="input-group">
                                <textarea name="reviews_msg" class="form-control" style="height: 40px;" placeholder="Type Here..."></textarea>
                                <input type="hidden" id="product_id" name="product_id" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-paper-plane mr-2"></i>Send</button>
                                    <input type="hidden" name="action_post_reviews">
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>