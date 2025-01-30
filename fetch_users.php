<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

// Fetch users where role is blank
$query = "SELECT user_id, name, created_at, verify FROM users WHERE role = '' OR role IS NULL";
$result = mysqli_query($conn, $query);

if (!$result) {
    die(json_encode(["error" => mysqli_error($conn)]));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode(["data" => $data]);
?>
