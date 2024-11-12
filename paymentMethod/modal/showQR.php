<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content-show-qr" id="modal-content">
			<div class="modal-header" style="border-bottom:none">
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex justify-content-center" id="receipt">
				<img src=" " class="modal-img">
			</div>
		</div>
	</div>
</div>
<script>
	document.addEventListener("click", function (e) {
		if (e.target.classList.contains("receipt-item")) {
			const src = e.target.getAttribute("src");
			document.querySelector(".modal-img").src = src;
			var myModal = new bootstrap.Modal(document.getElementById('qrModal'))
			myModal.show();
		}
	})
</script>