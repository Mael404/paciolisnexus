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
$student_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $quiz_title = mysqli_real_escape_string($conn, $_POST['quiz_title']);
    $gcash_name = mysqli_real_escape_string($conn, $_POST['gcash_name']);
    $gcash_number = mysqli_real_escape_string($conn, $_POST['gcash_number']);
    $mds = 1;

    // Generate unique gamefied_id
    $gamefied_id = '01000' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

    // Ensure gamefied_id is unique in the database
    do {
        $check_query = "SELECT COUNT(*) AS count FROM gamified WHERE gamefied_id = '$gamefied_id'";
        $result = mysqli_query($conn, $check_query);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] > 0) {
            $gamefied_id = '01000' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        }
    } while ($row['count'] > 0);

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

    // Insert the data into the database, including gamefied_id
    $query = "INSERT INTO gamified (gamefied_id, student_id, full_name, birthdate, address, quiz_title, gcash_name, gcash_number, payment_proof, mds) 
              VALUES ('$gamefied_id', '$student_id', '$full_name', '$birthdate', '$address', '$quiz_title', '$gcash_name', '$gcash_number', '$file_path', '$mds')";

    if (mysqli_query($conn, $query)) {
        // Redirect to success.html on success
        header("Location: success.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
