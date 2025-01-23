<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

$query = "SELECT gamefied_id, full_name, birthdate, address, quiz_title, gcash_name, gcash_number, payment_proof, created_at, status FROM gamified";
$result = mysqli_query($conn, $query);

if (!$result) {
    die(json_encode(["error" => mysqli_error($conn)]));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Return the URL of the payment proof
    if (!empty($row['payment_proof'])) {
        $row['payment_proof'] = $row['payment_proof']; // Just return the URL
    } else {
        $row['payment_proof'] = 'No proof provided';
    }
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    "data" => $data
]);
?>
