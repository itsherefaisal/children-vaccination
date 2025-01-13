<?php
session_start();
require_once '../../config.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $child_id = $_POST['child_id'] ?? null;
    $name = $_POST['name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';

    if ($child_id && !empty($name) && !empty($dob) && !empty($gender)) {
        $stmt = $conn->prepare("UPDATE children SET name = ?, dob = ?, gender = ? WHERE child_id = ?");
        $stmt->bind_param("sssi", $name, $dob, $gender, $child_id);

        if ($stmt->execute()) {
                $response['success'] = true;
        } else {
                $response['message'] = 'Database error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
            $response['message'] = 'Please fill all required fields.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>