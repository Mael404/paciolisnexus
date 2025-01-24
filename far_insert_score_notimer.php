<?php
// Include the database configuration
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = $_POST['score'];
    $gamified_id = $_POST['gamified_id']; // Get gamified_id from the form input

    // Validate input
    if (!empty($score) && is_numeric($score) && !empty($gamified_id)) {
        // Check if the gamified_id exists in the gamified table
        $check_stmt = $conn->prepare("SELECT timer, attempt FROM gamified WHERE gamefied_id = ?");
        $check_stmt->bind_param("i", $gamified_id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the timer column to 'enabled' and increment the attempt column
            $update_stmt = $conn->prepare("UPDATE gamified SET attempt = attempt + 1 WHERE gamefied_id = ?");
            $update_stmt->bind_param("i", $gamified_id);

            if ($update_stmt->execute()) {
                echo "Gamified data updated successfully.";
            } else {
                echo "Error updating gamified data: " . $update_stmt->error;
            }

            $update_stmt->close();
        } else {
            echo "No matching gamified_id found in the gamified table.";
        }

        $check_stmt->close();
    } else {
        echo "Invalid input."; // Handle validation errors
    }

    $conn->close(); // Close the database connection
}
?>
