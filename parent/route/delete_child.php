<?php
session_start();
require_once '../../config.php';

$child_id = $_GET['child_id'] ?? null;
$child_name = null;

if ($child_id) {
    $stmt2 = $conn->prepare("SELECT name FROM children WHERE child_id = ?");
    $stmt2->bind_param("i", $child_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $child = $result->fetch_assoc();
    $child_name = $child['name'];

    $stmt = $conn->prepare("DELETE FROM children WHERE child_id = ?");
    $stmt->bind_param("i", $child_id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Child deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No record found for the given child ID.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete child: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid or missing child ID.']);
}
header("Location: ./children.php?deleted_child={$child_name}");
$conn->close();
