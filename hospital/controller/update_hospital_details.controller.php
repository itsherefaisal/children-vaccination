<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hospital_id = $_POST['hospital_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $query = $conn->prepare("
        UPDATE hospitals 
        SET name = ?, email = ?, contact_number = ?, country = ?, state = ?, city = ?, address = ? 
        WHERE hospital_id = ?
    ");
    $query->bind_param("sssssssi", $name, $email, $phone, $country, $state, $city, $address, $hospital_id);

    if ($query->execute()) {
        header("Location: ../route/settings.php?message=Hospital details updated successfully!");
        exit;
    } else {
        echo "Error updating hospital details: " . $conn->error;
    }
}
?>
