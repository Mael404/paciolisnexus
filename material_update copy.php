<?php
include 'config.php'; // Include your database connection

// Check if the POST request contains the necessary data
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Start a transaction to ensure both operations are executed together
    $conn->begin_transaction();

    try {
        // Prepare the SQL query to update the status in material_access table
        $sqlUpdate = "UPDATE material_access SET status = ? WHERE id = ?";
        
        if ($stmtUpdate = $conn->prepare($sqlUpdate)) {
            $stmtUpdate->bind_param('si', $status, $id); // 'si' means string and integer types
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
        $sqlInsert = "UPDATE materials SET student_id = ? WHERE id = ?";
        if ($stmtInsert = $conn->prepare($sqlInsert)) {
            $stmtInsert->bind_param('ii', $student_id, $material_id); // 'ii' means two integer types
            if (!$stmtInsert->execute()) {
                throw new Exception('Failed to insert student_id into materials table');
            }
            $stmtInsert->close();
        } else {
            throw new Exception('Failed to prepare insert statement');
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
