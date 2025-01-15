<?php
require_once '../../config.php';
session_start();

$vaccine_id = $_POST['vaccine_id'];
$action = $_POST['action'];

if ($action !== 'increase' && $action !== 'decrease') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

if ($action == 'increase') {
    $query = "UPDATE hospital_vaccines SET stock_available = stock_available + 1 WHERE vaccine_id = ? AND hospital_id = ?";
} else {
    $query = "UPDATE hospital_vaccines SET stock_available = stock_available - 1 WHERE vaccine_id = ? AND hospital_id = ? AND stock_available > 0";
}

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $vaccine_id, $_SESSION['hospital_id']);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating stock']);
}

$stmt->close();
$conn->close();
?>
