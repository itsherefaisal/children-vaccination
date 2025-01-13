<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $query = $conn->prepare("UPDATE parents SET first_name = ?, last_name = ?, phone_number = ?, country = ?, city = ?, address = ? WHERE parent_id = ?");
    $query->bind_param("ssssssi", $first_name, $last_name, $phone, $country, $city, $address, $user_id);

    if ($query->execute()) {
        echo "User details updated successfully!";
        header("Location: ../route/settings.php");
    } else {
        echo "Error updating user details: " . $conn->error;
    }
}
?>
