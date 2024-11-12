<?php
include "../../connection/index.php";
session_start();
$adminId = $_SESSION['login_id'];
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

// Upload image to ImgBB
$imageFile = $_FILES['file']['tmp_name'];
$imageData = base64_encode(file_get_contents($imageFile)); // Convert the image to base64

$apiKey = '1129ed162824f2cede65deb4519d8415'; // Your ImgBB API key
$postData = [
    'key' => $apiKey,
    'image' => $imageData
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);


if (isset($responseData['data']['url'])) {
    $imageUrl = $responseData['data']['url'];
    $sql = "INSERT INTO bank (bankName, accountNumber, name, image) 
            VALUES ('$nameBank', '$accountNumber', '$ownerName', '$imageUrl')";

    if ($conn->query($sql) === TRUE) {
        header('Content-Type: application/json');
        $response = ['status' => '200', 'message' => 'success'];
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        $response = ['status' => '500', 'message' => 'Error inserting bank record: ' . $conn->error];
        echo json_encode($response);
    }
} else {
    header('Content-Type: application/json');
    $response = ['status' => 'error', 'message' => 'Image upload to ImgBB failed: ' . $responseData['error']['message']];
    echo json_encode($response);
}

$conn->close();
?>