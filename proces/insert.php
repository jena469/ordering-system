<?php
session_start();
require "../connection/index.php";

$stmt = $conn->prepare("INSERT INTO tbl_registration (fname, m_name, lname, userCode, password) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sssss", $fname, $m_name, $lname, $username, $password);

$fname = $_POST['fname'];
$m_name = $_POST['m_name'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = md5($_POST['password']);


if ($stmt->execute()) {
	$last_id = $conn->insert_id;
	$_SESSION['reg_id'] = $last_id;
	$_SESSION['user'] = 'user';
	$_SESSION['customerName'] = $fname . ' ' . $m_name . ' ' . $lname;
	echo json_encode(['status' => 'success', 'message' => 'Successfully created an account.']);
} else {
	echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}


$stmt->close();
$conn->close();