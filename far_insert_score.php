<?php
// Include the database configuration
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = $_POST['score'];
    $gamified_id = $_POST['gamified_id']; // Get gamified_id from the form input

    // Validate input
    if (!empty($score) && is_numeric($score) && !empty($gamified_id)) {
        // Prepare and execute the SQL query to insert both score and gamified_id
        $stmt = $conn->prepare("INSERT INTO leaderboards (score, transaction_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $score, $gamified_id); // Bind both score and gamified_id as integers

        if ($stmt->execute()) {
            header("Location: student_takequiz.php"); // Redirect if the insertion is successful
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
