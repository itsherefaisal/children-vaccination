<?php
session_start();
require_once '../../config.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['parent_id'])) {
        $parent_id = $_SESSION['parent_id'];
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        if (!empty($name) && !empty($dob) && !empty($gender)) {
            $stmt = $conn->prepare("INSERT INTO children (parent_id, name, dob, gender) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $parent_id, $name, $dob, $gender);

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
        $response['message'] = 'Unauthorized access. Please log in.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
