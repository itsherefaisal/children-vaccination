<?php
header('Content-Type: application/json');
session_start();

require '../../config.php';
$parent = $_SESSION['parent_id'] ?? null;
$child = $_POST['child'] ?? null;
$hospital = $_POST['hospital'] ?? null;
$vaccine = $_POST['vaccine'] ?? null;
$appointmentDate = $_POST['appointmentDate'] ?? null;

if (!$child || !$hospital || !$vaccine || !$appointmentDate) {
    echo json_encode(['success' => false, 'message' => 'Invalid input. All fields are required.']);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO appointments (parent_id, child_id, hospital_id, vaccine_id, appointment_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiis", $parent, $child, $hospital, $vaccine, $appointmentDate);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'appointment_id' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add appointment.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
