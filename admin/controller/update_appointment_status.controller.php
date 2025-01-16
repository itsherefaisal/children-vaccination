<?php
require_once '../../config.php';

header('Content-Type: application/json'); 

$response = [];

if (isset($_POST['appointment_id']) && isset($_POST['status'])) {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    if ($status === 'Approved') {
        $query = "UPDATE appointments SET status = ? WHERE appointment_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $appointment_id);

        if ($stmt->execute()) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Database error: ' . $stmt->error;
        }
    } else {
        $response['status'] = 'invalid_status';
        $response['message'] = 'Only "Approved" status is allowed.';
    }
} else {
    $response['status'] = 'missing_data';
    $response['message'] = 'Required data is missing.';
}

echo json_encode($response);
?>
