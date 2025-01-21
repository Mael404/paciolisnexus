<?php
// Include the database connection
include 'config.php';

// Start the session
session_start();

// Check if the user is logged in and has a valid session
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit;
}

// Get the current user ID from the session
$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $subject_title = mysqli_real_escape_string($conn, $_POST['quiz_title']); // Map quiz_title to subject_title
    $gcash_name = mysqli_real_escape_string($conn, $_POST['gcash_name']);
    $assignment_question = mysqli_real_escape_string($conn, $_POST['question']); // Assignment question
    $assignment_difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']); // Detected difficulty
    $afar = 1;
    $status = "Pending"; // Default status for new records
    $created_at = date("Y-m-d H:i:s"); // Timestamp for record creation
    // Collect form data
$urgency = isset($_POST['urgency']) ? mysqli_real_escape_string($conn, $_POST['urgency']) : NULL;


    // Generate unique transaction_id
    $transaction_id = 'TRX' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

    // Ensure transaction_id is unique in the database
    $check_query = "SELECT COUNT(*) AS count FROM homeworkhelp WHERE transaction_id = '$transaction_id'";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_assoc($result);

    while ($row['count'] > 0) {
        $transaction_id = 'TRX' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $result = mysqli_query($conn, $check_query);
        $row = mysqli_fetch_assoc($result);
    }

    // Handle the file upload
    if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['payment_proof']['tmp_name'];
        $file_name = $_FILES['payment_proof']['name'];
        $upload_dir = 'uploads/'; // Ensure this folder exists and has write permissions
        $file_path = $upload_dir . basename($file_name);

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($file_tmp, $file_path)) {
            echo "Error uploading file.";
            exit;
        }
    } else {
        echo "File upload failed.";
        exit;
    }

    $query = "INSERT INTO homeworkhelp (transaction_id, user_id, afar, status, subject_title, 
          assignment_difficulty, assignment_question, full_name, birthdate, address, 
          gcash_name, payment_proof, created_at, urgency) 
          VALUES ('$transaction_id', '$user_id', '$afar', '$status', '$subject_title', 
          '$assignment_difficulty', '$assignment_question', '$full_name', '$birthdate', '$address', 
          '$gcash_name', '$file_path', NOW(), '$urgency')";
    if (mysqli_query($conn, $query)) {
        // Redirect to success.html on success
        header("Location: success.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
