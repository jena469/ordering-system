<?php
require_once('../connection/index.php');



$email = $_POST['email'];

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM tbl_registration WHERE userCode = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
	echo 'exists';
} else {
	echo 'not exists';
}

$stmt->close();
$conn->close();
?>