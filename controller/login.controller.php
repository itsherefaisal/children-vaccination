<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
        exit;
    }

    $sql = "SELECT parent_id, email, password FROM parents WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['parent_id'] = $user['parent_id'];
            $_SESSION['parent_email'] = $user['email'];
            echo json_encode(['status' => 'success', 'role' => 'parent', 'message' => 'Login successful!']);
            exit;
        }
    }

    $adminSql = "SELECT admin_id, email, password FROM admins WHERE email = ?";
    $adminStmt = $conn->prepare($adminSql);
    $adminStmt->bind_param("s", $email);
    $adminStmt->execute();
    $adminResult = $adminStmt->get_result();

    if ($adminResult->num_rows === 1) {
        $admin = $adminResult->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            session_start();
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_email'] = $admin['email'];
            echo json_encode(['status' => 'success', 'role' => 'admin', 'message' => 'Admin login successful!']);
            exit;
        }
    }

    echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);

    $stmt->close();
    $adminStmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
