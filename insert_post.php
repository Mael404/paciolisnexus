<?php
session_start();
include('config.php'); // Include your database configuration file

// Check if the user is logged in (session is active)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  // Get user_id from the session
    $content = mysqli_real_escape_string($conn, $_POST['content']);  // Get the content from the POST request

    // Fetch the user's name from the users table based on the user_id
    $sql = "SELECT name FROM users WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);  // Bind the user_id (int)
        $stmt->execute();
        $stmt->store_result();
        
        // Check if the user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_name);
            $stmt->fetch();
            
            // Insert the post along with the user's name
            $sql_insert = "INSERT INTO posts (user_id, user_name, content, created_at) VALUES (?, ?, ?, NOW())";
            
            if ($stmt_insert = $conn->prepare($sql_insert)) {
                $stmt_insert->bind_param("iss", $user_id, $user_name, $content);  // Bind the user_id, user_name (string), and content (string)
                
                // Execute the query
                if ($stmt_insert->execute()) {
                    echo "Post submitted successfully!";
                } else {
                    echo "Error: " . $stmt_insert->error;
                }
                $stmt_insert->close();
            }
        } else {
            echo "User not found.";
        }
        $stmt->close();
    }
} else {
    echo "User not logged in.";
}

$conn->close();  // Close the database connection
?>
