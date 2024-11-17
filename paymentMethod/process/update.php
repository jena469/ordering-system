<?php
require "../../connection/index.php";
session_start();

if (isset($_POST['id'], $_POST['mode'], $_POST['accountNum'], $_POST['name'])) {
    $id = $_POST['id'];
    $mode = strtoupper(htmlspecialchars($_POST['mode']));
    $accountNum = $_POST['accountNum'];
    $name = strtoupper(htmlspecialchars($_POST['name']));

    // Initialize variable for image data
    $imageData = null;

    // Check if a new image is uploaded
    if (isset($_FILES['editImgs']) && $_FILES['editImgs']['error'] === UPLOAD_ERR_OK) {
        // Read the image file as binary data
        $fileTmpName = $_FILES['editImgs']['tmp_name'];
        $imageData = file_get_contents($fileTmpName); // Read the binary image file
    } else {
        // No new image uploaded, retrieve the current image data from the database
        $query = "SELECT image FROM bank WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Assign current image data if exists
        if ($row) {
            $imageData = $row['image'];
        }
        $stmt->close();
    }

    // Prepare the update statement
    if ($imageData !== null) {
        // Update with new image data
        $sql = "UPDATE bank SET 
                bankName=?, 
                accountNumber=?, 
                name=?, 
                image=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $mode, $accountNum, $name, $imageData, $id);
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
} else {
    header('Content-Type: application/json');
    $response = ['status' => '400', 'message' => 'Missing required fields.'];
    echo json_encode($response);
}
?>