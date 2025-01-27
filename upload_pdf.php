<?php
session_start(); // Start the session to access session variables
require_once 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
        // File details
        $fileName = $_FILES['pdfFile']['name'];
        $fileTmp = $_FILES['pdfFile']['tmp_name'];
        $uploadDir = "uploads/"; // Ensure this directory exists and is writable
        $filePath = $uploadDir . basename($fileName);

        // Check if user_id is set in the session
        if (isset($_SESSION['user_id'])) {
            $cpa_id = $_SESSION['user_id']; // Get the user_id from the session

            // Fetch the user's name from the users table
            $stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $cpa_id);
            $stmt->execute();
            $stmt->bind_result($name);
            $stmt->fetch();
            $stmt->close();

            if ($name) {
                // Move the uploaded file
                if (move_uploaded_file($fileTmp, $filePath)) {
                    // Insert data into materials table with cpa_id and name
                    $stmt = $conn->prepare("INSERT INTO materials (file_name, file_path, uploaded_at, cpa_id, name) VALUES (?, ?, NOW(), ?, ?)");
                    $stmt->bind_param("ssis", $fileName, $filePath, $cpa_id, $name);

                    if ($stmt->execute()) {
                        // Redirect to upload success page
                        header("Location: uploadsucess.php");
                        exit; // Ensure the script stops after redirection
                    } else {
                        echo "Failed to save file information to database: " . $conn->error;
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "User name not found. Please log in again.";
            }
        } else {
            echo "User is not logged in. Please log in to upload files.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}
?>
