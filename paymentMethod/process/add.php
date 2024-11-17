<?php
include "../../connection/index.php";
session_start();

$nameBank = strtoupper(htmlspecialchars($_POST['nameBank']));
$accountNumber = htmlspecialchars($_POST['accountNumber']);
$ownerName = strtoupper(htmlspecialchars($_POST['ownerName']));

// Check for upload errors
if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    header('Content-Type: application/json');
    $response = ['status' => '400', 'message' => 'File upload failed'];
    echo json_encode($response);
    exit;
}

// Read the image file and prepare for database insertion
$imageFile = $_FILES['file']['tmp_name'];
$imageData = file_get_contents($imageFile); // Get binary data of the image
$imageType = mime_content_type($imageFile); // Get the MIME type of the image

// Check if the file is a valid image
if (strpos($imageType, 'image/') !== 0) {
    header('Content-Type: application/json');
    $response = ['status' => '400', 'message' => 'Uploaded file is not a valid image'];
    echo json_encode($response);
    exit;
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO bank (bankName, accountNumber, name, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nameBank, $accountNumber, $ownerName, $imageData);

// Execute the statement and check for success
if ($stmt->execute()) {
    header('Content-Type: application/json');
    $response = ['status' => '200', 'message' => 'success'];
    echo json_encode($response);
} else {
    header('Content-Type: application/json');
    $response = ['status' => '500', 'message' => 'Error inserting bank record: ' . $stmt->error];
    echo json_encode($response);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>