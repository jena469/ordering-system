<?php
require "../../connection/index.php";
session_start();
$adminId = $_SESSION['login_id'];

if (isset($_POST['id'], $_POST['mode'], $_POST['accountNum'], $_POST['name'])) {
    $id = $_POST['id'];
    $mode = strtoupper(htmlspecialchars($_POST['mode']));
    $accountNum = $_POST['accountNum'];
    $name = strtoupper(htmlspecialchars($_POST['name']));

    // Initialize variable for image URL
    $imageUrl = null;

    // Check if a new image is uploaded
    if (isset($_FILES['editImgs']) && $_FILES['editImgs']['error'] === UPLOAD_ERR_OK) {
        // New image uploaded
        $fileTmpName = $_FILES['editImgs']['tmp_name'];
        $fileData = file_get_contents($fileTmpName); // Read the image file

        // Upload to ImgBB
        $apiKey = '1129ed162824f2cede65deb4519d8415'; // Your ImgBB API key
        $url = 'https://api.imgbb.com/1/upload'; // ImgBB upload URL
        $data = [
            'key' => $apiKey,
            'image' => base64_encode($fileData) // Encode image data to base64
        ];

        // Use cURL to upload the image
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $responseData = json_decode($response, true);
        if (isset($responseData['data']['url'])) {
            $imageUrl = $responseData['data']['url']; // Get the image URL
        } else {
            // Handle error in uploading image
            header('Content-Type: application/json');
            $response = ['status' => '500', 'message' => 'Error uploading image: ' . $responseData['error']];
            echo json_encode($response);
            exit;
        }
    } else {
        // No new image uploaded, retrieve the current image URL from the database
        $query = "SELECT image FROM bank WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Assign current image URL if exists
        if ($row) {
            $imageUrl = $row['image'];
        }
        $stmt->close();
    }

    // Prepare the update statement
    if ($imageUrl !== null) {
        // Update with new image URL
        $sql = "UPDATE bank SET 
                bankName=?, 
                accountNumber=?, 
                name=?, 
                image=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $mode, $accountNum, $name, $imageUrl, $id);
    } else {
        // Update without changing the image
        $sql = "UPDATE bank SET 
                bankName=?, 
                accountNumber=?, 
                name=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $mode, $accountNum, $name, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        header('Content-Type: application/json');
        $response = ['status' => '200', 'message' => 'success'];
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        $response = ['status' => '500', 'message' => 'Error updating record: ' . $stmt->error];
        echo json_encode($response);
    }

    $stmt->close();
    if (isset($logStmt)) {
        $logStmt->close();
    }
} else {
    header('Content-Type: application/json');
    $response = ['status' => '400', 'message' => 'Missing required fields.'];
    echo json_encode($response);
}
?>