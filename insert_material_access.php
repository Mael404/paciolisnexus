<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $material_id = $conn->real_escape_string($_POST['transactionId']);
    $full_name = $conn->real_escape_string($_POST['fullName']);
    $gcash_number = $conn->real_escape_string($_POST['gcashNumber']);
    $gcash_name = $conn->real_escape_string($_POST['gcashName']);
    
    // Get user_id from session
    session_start(); // Ensure the session is started
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Get user_id from session
    
    if ($user_id === null) {
        die("User not logged in."); // Handle the case when user is not logged in
    }
    
    // Handle file upload for proof of payment
    $proof_of_payment = "";
    if (isset($_FILES['proofOfPayment']) && $_FILES['proofOfPayment']['error'] == 0) {
        $upload_dir = "uploads/"; // Directory where files will be saved
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }

        $file_name = basename($_FILES['proofOfPayment']['name']);
        $target_file = $upload_dir . uniqid() . "_" . $file_name; // Add unique ID to filename

        if (move_uploaded_file($_FILES['proofOfPayment']['tmp_name'], $target_file)) {
            $proof_of_payment = $target_file;
        } else {
            die("Error uploading proof of payment.");
        }
    }

    // Insert data into the material_access table, including student_id (user_id)
    $sql = "INSERT INTO material_access (material_id, full_name, gcash_number, gcash_name, proof_of_payment, student_id, created_at)
            VALUES ('$material_id', '$full_name', '$gcash_number', '$gcash_name', '$proof_of_payment', '$user_id', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: material_success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
