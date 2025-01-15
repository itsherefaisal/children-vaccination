<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    $query = "UPDATE appointments SET status = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $appointment_id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Status updated successfully!']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Failed to update status.']);
    }
}
?>
