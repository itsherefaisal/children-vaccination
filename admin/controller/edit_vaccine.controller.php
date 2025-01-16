<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vaccine_id = $_POST['vaccine_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $doses_required = $_POST['doses_required'];
    $recommended_age = $_POST['recommended_age'];
    $status = $_POST['status'];

    $query = $conn->prepare("UPDATE vaccines SET name = ?, description = ?, doses_required = ?, recommended_age = ?, status = ? WHERE vaccine_id = ?");
    $query->bind_param("ssissi", $name, $description, $doses_required, $recommended_age, $status, $vaccine_id);

    if ($query->execute()) {
        header("Location: ../route/vaccines.php?message=Vaccine updated successfully");
        exit();
    } else {
        echo "Error: " . $query->error;
    }
}
?>
