<?php 

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $user_id = $_POST['user_id']; 
    $action = $_POST['action'];

    // Determine the verify status based on the action
    if ($action == 'approve') {
        $verify = 1; // Approved
    } else if ($action == 'deny') {
        $verify = 2; // Denied
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit;
    }

    // Check if user_id exists in the users table
    $checkQuery = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (!$result) {
        echo json_encode(['success' => false, 'message' => 'Database query error: ' . mysqli_error($conn)]);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Update the verify status in the users table
        $updateQuery = "UPDATE users SET verify = $verify WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $updateQuery)) {
            
            // Additional condition: Check if the user_id exists in cpa_details
            $checkCPAQuery = "SELECT * FROM cpa_details WHERE user_id = '$user_id'";
            $cpaResult = mysqli_query($conn, $checkCPAQuery);

            if (!$cpaResult) {
                echo json_encode(['success' => false, 'message' => 'Database query error (CPA Details): ' . mysqli_error($conn)]);
                exit;
            }

            // If user_id exists in cpa_details, update status to "Verified"
            if (mysqli_num_rows($cpaResult) > 0) {
                $updateCPAQuery = "UPDATE cpa_details SET status = 'Verified' WHERE user_id = '$user_id'";
                if (!mysqli_query($conn, $updateCPAQuery)) {
                    echo json_encode(['success' => false, 'message' => 'Failed to update CPA Details status: ' . mysqli_error($conn)]);
                    exit;
                }
            }

            echo json_encode(['success' => true, 'message' => 'Status updated successfully in both tables']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update users table status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No record found for this user ID']);
    }
}
?>
