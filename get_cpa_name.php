<?php
include('config.php');  // Include the configuration file to connect to your database

if (isset($_POST['cpa_id'])) {
    $cpa_id = $_POST['cpa_id'];

    // Query to get the name based on the CPA ID
    $sql = "SELECT name FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cpa_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['name'];  // Output the CPA name
    } else {
        echo 'No CPA found';
    }

    $stmt->close();
}
?>
