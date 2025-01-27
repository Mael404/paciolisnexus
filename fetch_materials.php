<?php
include 'config.php'; // Include your database connection

header('Content-Type: application/json');

$sql = "SELECT id, material_id, full_name, gcash_number, gcash_name, proof_of_payment, created_at, status FROM material_access"; // Add status column here
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode(['data' => $data]);
?>
