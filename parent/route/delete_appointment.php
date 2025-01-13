<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    $deleteQuery = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
    $deleteQuery->bind_param("i", $appointment_id);

    if ($deleteQuery->execute()) {
        if ($deleteQuery->affected_rows > 0) {
            $response = [
                'success' => true,
                'message' => 'Appointment deleted successfully.',
            ];
            header("Location: ./appointments.php");
        } else {
            $response = [
                'success' => false,
                'message' => 'No appointment found with the given ID.',
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Error occurred while deleting the appointment.',
        ];
    }

    $deleteQuery->close();
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid request. Please provide an appointment ID.',
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
