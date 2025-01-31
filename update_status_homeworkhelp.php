<?php 

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $transaction_id = $_POST['transaction_id'];
    $action = $_POST['action'];
    
    // Validate the action
    if ($action == 'approve') {
        $status = 'Active';
        $message = "Your transaction has successfully been approved!";
    } else if ($action == 'deny') {
        $status = 'Denied';
        $message = "Your transaction has been denied.";
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit;
    }

    // Check if transaction_id exists in the table
    $checkQuery = "SELECT user_id FROM homeworkhelp WHERE transaction_id = '$transaction_id'";
    $result = mysqli_query($conn, $checkQuery);

    // Error handling for database query
    if (!$result) {
        echo json_encode(['success' => false, 'message' => 'Database query error: ' . mysqli_error($conn)]);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Retrieve the user_id
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        // Update the status in homeworkhelp table
        $updateQuery = "UPDATE homeworkhelp SET status = '$status' WHERE transaction_id = '$transaction_id'";
        if (mysqli_query($conn, $updateQuery)) {
            // Insert message into the messages table
            $insertMessageQuery = "INSERT INTO messages (student_id, message) VALUES ('$user_id', '$message')";
            if (mysqli_query($conn, $insertMessageQuery)) {
                echo json_encode(['success' => true, 'message' => 'Status updated and message sent successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert message: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No record found for this transaction ID']);
    }
}
?>
