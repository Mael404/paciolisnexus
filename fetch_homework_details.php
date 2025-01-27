<?php
// fetch_homework_details.php

include 'config.php';  // Include your database connection

if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    // Prepare the query to fetch the cpa_id, cpa_name, and answer for the given transaction_id
    $query = "SELECT cpa_id, cpa_name, answer FROM homeworkhelp WHERE transaction_id = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $transaction_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cpa_id, $cpa_name, $answer);
        mysqli_stmt_fetch($stmt);
        
        // Return the data as JSON
        echo json_encode(['cpa_id' => $cpa_id, 'cpa_name' => $cpa_name, 'answer' => $answer]);

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Failed to fetch details']);
    }
}
?>
