<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['status' => 'error', 'errors' => []];

    $first_name = $conn->real_escape_string(trim($_POST['first_name']));
    $last_name = $conn->real_escape_string(trim($_POST['last_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $country = $conn->real_escape_string(trim($_POST['country']));
    $city = $conn->real_escape_string(trim($_POST['city']));
    $address = $conn->real_escape_string(trim($_POST['address']));
    $phone_number = $conn->real_escape_string(trim($_POST['phone_number']));
    $type = $conn->real_escape_string(trim($_POST['type']));

    if (empty($first_name) || strlen($first_name) < 2) {
        $response['errors'][] = ['field' => 'first_name', 'code' => 1001, 'message' => 'First name must be at least 2 characters long.'];
    }
    if (empty($last_name) || strlen($last_name) < 2) {
        $response['errors'][] = ['field' => 'last_name', 'code' => 1002, 'message' => 'Last name must be at least 2 characters long.'];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors'][] = ['field' => 'email', 'code' => 1003, 'message' => 'Invalid email format.'];
    }
    if (strlen($password) < 6) {
        $response['errors'][] = ['field' => 'password', 'code' => 1004, 'message' => 'Password must be at least 6 characters long.'];
    }
    if ($password !== $confirm_password) {
        $response['errors'][] = ['field' => 'confirm_password', 'code' => 1005, 'message' => 'Passwords do not match.'];
    }
    if (empty($country)) {
        $response['errors'][] = ['field' => 'country', 'code' => 1006, 'message' => 'Country is required.'];
    }
    if (empty($city)) {
        $response['errors'][] = ['field' => 'city', 'code' => 1007, 'message' => 'City is required.'];
    }
    if (empty($address)) {
        $response['errors'][] = ['field' => 'address', 'code' => 1008, 'message' => 'Address is required.'];
    }
    if (!preg_match('/^\+?[0-9]{10,15}$/', $phone_number)) {
        $response['errors'][] = ['field' => 'phone_number', 'code' => 1009, 'message' => 'Invalid phone number format.'];
    }
    if (!in_array($type, ['Father', 'Mother'])) {
        $response['errors'][] = ['field' => 'type', 'code' => 1010, 'message' => 'Invalid type selected.'];
    }

    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT parent_id FROM parents WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response['errors'][] = ['field' => 'email', 'code' => 1011, 'message' => 'Email already exists.'];
        echo json_encode($response);
        $stmt->close();
        exit;
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO parents (first_name, last_name, email, password, country, city, address, phone_number, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $hashed_password, $country, $city, $address, $phone_number, $type);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        $response['errors'][] = ['field' => null, 'code' => 1012, 'message' => 'Registration failed. Please try again.'];
        echo json_encode($response);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>