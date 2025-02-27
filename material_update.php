<?php
include 'config.php'; // Include your database connection

// Check if the POST request contains the necessary data
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Start a transaction to ensure all operations are executed together
    $conn->begin_transaction();

    try {
        // Update the status in material_access table
        $sqlUpdate = "UPDATE material_access SET status = ? WHERE id = ?";
        if ($stmtUpdate = $conn->prepare($sqlUpdate)) {
            $stmtUpdate->bind_param('si', $status, $id);
            if (!$stmtUpdate->execute()) {
                throw new Exception('Failed to update status');
            }
            $stmtUpdate->close();
        } else {
            throw new Exception('Failed to prepare update statement');
        }

        // Retrieve student_id and material_id from material_access table
        $sqlSelect = "SELECT student_id, material_id FROM material_access WHERE id = ?";
        if ($stmtSelect = $conn->prepare($sqlSelect)) {
            $stmtSelect->bind_param('i', $id);
            $stmtSelect->execute();
            $stmtSelect->bind_result($student_id, $material_id);
            $stmtSelect->fetch();
            $stmtSelect->close();
        } else {
            throw new Exception('Failed to prepare select statement');
        }

        // Insert student_id into the materials table where material_id matches
        $sqlInsertMaterial = "UPDATE materials SET student_id = ? WHERE id = ?";
        if ($stmtInsertMaterial = $conn->prepare($sqlInsertMaterial)) {
            $stmtInsertMaterial->bind_param('ii', $student_id, $material_id);
            if (!$stmtInsertMaterial->execute()) {
                throw new Exception('Failed to update student_id in materials table');
            }
            $stmtInsertMaterial->close();
        } else {
            throw new Exception('Failed to prepare insert statement for materials');
        }

        // Send a success message to the user
        $message = "Your transaction has successfully been approved!";
        $sqlInsertMessage = "INSERT INTO messages (student_id, message) VALUES (?, ?)";
        if ($stmtInsertMessage = $conn->prepare($sqlInsertMessage)) {
            $stmtInsertMessage->bind_param('is', $student_id, $message);
            if (!$stmtInsertMessage->execute()) {
                throw new Exception('Failed to insert message into messages table');
            }
            $stmtInsertMessage->close();
        } else {
            throw new Exception('Failed to prepare insert message statement');
        }

        // Commit the transaction if all queries are successful
        $conn->commit();

        // Return success response
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        $conn->rollback();

        // Return error response
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Missing id or status']);
}
?>