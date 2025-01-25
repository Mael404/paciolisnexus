<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

// Updated query: Removed 'phone' and added 'status'
$query = "SELECT user_id, full_name, diploma, gov_id, selfie, modules, license, status, created_at FROM cpa_details";
$result = mysqli_query($conn, $query);

if (!$result) {
    die(json_encode(["error" => mysqli_error($conn)]));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure image paths are returned correctly
    foreach (['diploma', 'gov_id', 'selfie', 'modules', 'license'] as $imageColumn) {
        if (!empty($row[$imageColumn])) {
            $row[$imageColumn] = $row[$imageColumn];
        } else {
            $row[$imageColumn] = 'No image provided';
        }
    }
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    "data" => $data
]);
?>
