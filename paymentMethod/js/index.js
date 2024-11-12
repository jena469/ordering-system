handlePlan("active");

function handlePlan(bankStatus = "active") {
  var activeButton = document.getElementById("activeButton");
  var archiveButton = document.getElementById("archiveButton");

  activeButton.classList.remove("active");
  archiveButton.classList.remove("active");

  activeButton.style.backgroundColor = bankStatus === "active" ? "#23D160" : "";
  activeButton.style.color = bankStatus === "active" ? "#fff" : "";
  archiveButton.style.backgroundColor =
    bankStatus === "archive" ? "#FF3860" : "";
  archiveButton.style.color = bankStatus === "archive" ? "#fff" : "";
  activeButton.style.outline = bankStatus === "active" ? "none" : "";
  archiveButton.style.outline = bankStatus === "archive" ? "none" : "";

  const bank = document.getElementById("bank").value;
  const parseBank = JSON.parse(bank);
  const tbody = document.getElementById("tbody");
  let htmlContent = "";
  const container = parseBank.filter(({ status }) => bankStatus === status);

  for (let i = 0; i < container.length; i++) {
    const bankRow = container[i];
    htmlContent += `
			<tr class="text-center">
				<td class="text-nowrap">${bankRow.bankName}</td>
				<td class="text-nowrap">${bankRow.accountNumber}</td>
				<td class="text-nowrap">${bankRow.name}</td>
				<td class="text-nowrap">
					<img src="${
            bankRow.imageData
          }" style="width: 50px; cursor: pointer;" onclick="showReceipt('${
      bankRow.imageData
    }')">

				</td>
					<td>
						<div class="btn-group" role="group" aria-label="Plan Actions">
							<button type="button" class="btn btn-primary btn-sm  btn-action" data-toggle="modal" onclick="openModal('${encodeURIComponent(
                JSON.stringify(bankRow)
              )}')">
								<span class="icon-span">
									<i class="fas fa-edit"></i>
								</span>
							</button>
							<button type="button" class="btn btn-warning btn-sm btn-action"
								onclick="handleAction(${bankRow.id}, '${bankStatus}')">
								<span class="icon-span">
									<i class="fas fa-trash-alt text-white" ></i> 
								</span>
							</button>
						</div>
					</td>
			</tr>
		`;
  }
  if (container.length != 0) {
    tbody.innerHTML = htmlContent;
} else {
    tbody.innerHTML = `<tr class='text-center'>
							<td colspan='5'>NO RESULTS</td>
						</tr>`;
}

}

function handleAction(id, status) {
  Swal.fire({
    title: "Are you sure?",
    text: `Do you want to ${
      status === "active" ? "archive" : "active"
    } this bank?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: `Yes, ${status === "active" ? "archive" : "active"} it!`,
  }).then((result) => {
    if (result.isConfirmed) {
      performArchive(id, status);
    }
  });
}

function performArchive(id, status) {
  $("#loadingModal").modal("show");
  $("#loadingModal").on("hide.bs.modal", function (e) {
    e.preventDefault();
    e.stopPropagation();
    return false;
  });
  fetch(
    `./paymentMethod/process/archive.php?id=${id}&status=${
      status === "active" ? "archive" : "active"
    }`,
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    }
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "200") {
        $("#loadingModal").modal("hide");
        Swal.fire({
          title: "SUCCESS",
          text: `The payment method has been ${
            status === "active" ? "archive" : "active"
          }.`,
          icon: "success",
          timer: 1000,
          showConfirmButton: false,
        }).then(() => {
          window.location.reload();
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: "There was an error archiving the plan.",
          icon: "error",
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      Swal.fire({
        title: "Error!",
        text: "An unexpected error occurred.",
        icon: "error",
      });
    });
}

function showReceipt(imageBb) {
  var imageUrl = imageBb;
  document.querySelector(".modal-img").src = imageUrl;
  $("#qrModal").modal("show");
}

function openModal(bankRow) {
  console.log("click!!!");
  var bankDecoded = decodeURIComponent(bankRow);
  var originalObject = JSON.parse(bankDecoded);
  console.log("Bank Object:", originalObject);

  var idInput = document.getElementById("id");
  var mode = document.getElementById("mode");
  var accountNum = document.getElementById("accountNum");
  var name = document.getElementById("name");
  var images = document.getElementById("images");

  idInput.value = originalObject.id;
  mode.value = originalObject.bankName;
  accountNum.value = originalObject.accountNumber;
  name.value = originalObject.name;
  images.src = "data:image/jpeg;base64," + originalObject.imageData;
  $("#editBankDetails").modal("show");
}
