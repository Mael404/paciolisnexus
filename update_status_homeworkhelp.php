<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $transaction_id = $_POST['transaction_id'];
    $action = $_POST['action'];
    
    // Validate the action
    if ($action == 'approve') {
        $status = 'Active';
    } else if ($action == 'deny') {
        $status = 'Denied';
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit;
    }

    // Check if transaction_id exists in the table
    $checkQuery = "SELECT * FROM homeworkhelp WHERE transaction_id = '$transaction_id'";
    $result = mysqli_query($conn, $checkQuery);

    // Error handling for database query
    if (!$result) {
        echo json_encode(['success' => false, 'message' => 'Database query error: ' . mysqli_error($conn)]);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Update the status
        $updateQuery = "UPDATE homeworkhelp SET status = '$status' WHERE transaction_id = '$transaction_id'";
        if (mysqli_query($conn, $updateQuery)) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No record found for this transaction ID']);
    }
}
?>
