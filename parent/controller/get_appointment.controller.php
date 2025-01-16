<?php
session_start();
include '../../config.php';

if (!isset($_SESSION['parent_id']) || !isset($_GET['appointment_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

$user_id = $_SESSION['parent_id'];
$appointment_id = intval($_GET['appointment_id']);

$query = "
    SELECT a.appointment_date, a.status, 
           h.name AS hospital_name, 
           v.name AS vaccine_name, 
           c.name AS child_name
    FROM appointments a
    JOIN hospitals h ON a.hospital_id = h.hospital_id
    JOIN vaccines v ON a.vaccine_id = v.vaccine_id
    JOIN children c ON a.child_id = c.child_id
    JOIN parents p ON c.parent_id = p.parent_id
    WHERE a.appointment_id = ? AND p.parent_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $appointment_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $appointment]);
} else {
    echo json_encode(['success' => false, 'message' => 'Appointment not found']);
}
?>
