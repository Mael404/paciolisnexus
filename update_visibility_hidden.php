<?php
// update_visibility_hidden.php

// Include database connection (adjust as per your setup)
include('config.php');

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $fileId = $data['id'];
    
    // Update status to 'hidden' for the selected file
    $query = "UPDATE materials SET status = 'hidden' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $fileId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
