<?php
// Include the database configuration
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = $_POST['score'];
    $gamified_id = $_POST['gamified_id']; // Get gamified_id from the form input

    // Validate input
    if (!empty($score) && is_numeric($score) && !empty($gamified_id)) {
        // Check if gamified_id already exists in the transaction_id column of leaderboards
        $check_exists_stmt = $conn->prepare("SELECT transaction_id FROM leaderboards WHERE transaction_id = ?");
        $check_exists_stmt->bind_param("i", $gamified_id);
        $check_exists_stmt->execute();
        $check_exists_result = $check_exists_stmt->get_result();

        if ($check_exists_result->num_rows > 0) {
            // If gamified_id exists, redirect to timer_enabled.html
            header("Location: timer_enabled.html");
            exit();
        }

        // Prepare and execute the SQL query to insert both score and gamified_id into leaderboards
        $stmt = $conn->prepare("INSERT INTO leaderboards (score, transaction_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $score, $gamified_id); // Bind both score and gamified_id as integers

        if ($stmt->execute()) {
            // Check if the gamified_id exists in the gamified table
            $check_stmt = $conn->prepare("SELECT timer, attempt FROM gamified WHERE gamefied_id = ?");
            $check_stmt->bind_param("i", $gamified_id);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                // Update the timer column to 'enabled' and increment the attempt column
                $update_stmt = $conn->prepare("UPDATE gamified SET timer = 'enabled', attempt = attempt + 1 WHERE gamefied_id = ?");
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
            echo "Error: " . $stmt->error; // Display error if insertion fails
        }

        $stmt->close(); // Close the statement
    } else {
        echo "Invalid input."; // Handle validation errors
    }

    $conn->close(); // Close the database connection
}
?>
