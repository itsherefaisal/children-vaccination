<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hospital_id = $_POST['hospital_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $password = $_POST['password'];

    $query = "UPDATE hospitals SET name = ?, email = ?, contact_number = ?, address = ?, country = ?, state = ?, city = ?";

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query .= ", password = ?";
    }

    $query .= " WHERE hospital_id = ?";

    $stmt = $conn->prepare($query);

    if (!empty($password)) {
        $stmt->bind_param("ssssssssi", $name, $email, $phone, $address, $country, $state, $city, $hashed_password, $hospital_id);
    } else {
        $stmt->bind_param("sssssssi", $name, $email, $phone, $address, $country, $state, $city, $hospital_id);
    }

    if ($stmt->execute()) {
        header("Location: ../route/hospitals.php?message=Hospital detials updated successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
