<?php
require '../../connection/index.php';
session_start();

if (isset($_GET['id'], $_GET['status'])) {
	$planId = $_GET['id'];
	$status = $_GET['status'];

	// Get bank details
	$sqlGetBank = "SELECT accountNumber FROM bank WHERE id = ?";
	$stmtGetBank = $conn->prepare($sqlGetBank);
	$stmtGetBank->bind_param("i", $planId);
	$stmtGetBank->execute();
	$stmtGetBank->store_result();

	if ($stmtGetBank->num_rows > 0) {
		$stmtGetBank->bind_result($accountNumber);
		$stmtGetBank->fetch();

		// Update bank status
		$sqlUpdateBank = "UPDATE bank SET status = ? WHERE id = ?";
		$stmtUpdateBank = $conn->prepare($sqlUpdateBank);
		$stmtUpdateBank->bind_param("si", $status, $planId);

		if ($stmtUpdateBank->execute()) {
			header('Content-Type: application/json');
			$response = ['status' => '200', 'message' => 'success'];
			echo json_encode($response);
		} else {
			$response = array('status' => 'error', 'message' => 'Error updating bank record: ' . $stmtUpdateBank->error);
			echo json_encode($response);
		}
		$stmtUpdateBank->close();
	} else {
		$response = array('status' => 'error', 'message' => 'Bank record not found.');
		echo json_encode($response);
	}

	$stmtGetBank->close();
} else {
	$response = array('status' => 'error', 'message' => 'Missing required fields.');
	echo json_encode($response);
}
?>