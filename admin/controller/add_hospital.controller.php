<?php

require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "
        INSERT INTO hospitals (name, email, password, address, contact_number, city, state, country)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $name, $email, $hashed_password, $address, $contact_number, $city, $state, $country);

    if ($stmt->execute()) {
        header("Location: ../route/hospitals.php?message=Added new Hospital");
        exit();
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
