<?php
header('Content-Type: application/json');
require '../../config.php';

$appointment_id = $_POST['appointment_id'] ?? null;
$child = $_POST['child'] ?? null;
$hospital = $_POST['hospital'] ?? null;
$vaccine = $_POST['vaccine'] ?? null;
$appointmentDate = $_POST['appointmentDate'] ?? null;

if (!$appointment_id || !$child || !$hospital || !$vaccine || !$appointmentDate) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

try {
    $stmt = $conn->prepare("
        UPDATE appointments 
        SET child_id = ?, hospital_id = ?, vaccine_id = ?, appointment_date = ?
        WHERE appointment_id = ?
    ");
    $stmt->bind_param("iiisi", $child, $hospital, $vaccine, $appointmentDate, $appointment_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update appointment.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
