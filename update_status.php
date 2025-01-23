<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $gamefied_id = $_POST['gamefied_id'];
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

    // Check if gamefied_id exists in the table
    $checkQuery = "SELECT * FROM gamified WHERE gamefied_id = '$gamefied_id'";
    $result = mysqli_query($conn, $checkQuery);

    // Error handling for database query
    if (!$result) {
        echo json_encode(['success' => false, 'message' => 'Database query error: ' . mysqli_error($conn)]);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Update the status
        $updateQuery = "UPDATE gamified SET status = '$status' WHERE gamefied_id = '$gamefied_id'";
        if (mysqli_query($conn, $updateQuery)) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No record found for this ID']);
    }
}
?>
