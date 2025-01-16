<?php
require_once("../../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hospital_id = $_POST['hospital_id'];
    $vaccine_id = $_POST['vaccine_id'];
    $stock_available = $_POST['stock_available'];

    $checkQuery = $conn->prepare("SELECT * FROM hospital_vaccines WHERE hospital_id = ? AND vaccine_id = ?");
    $checkQuery->bind_param("ii", $hospital_id, $vaccine_id);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = $conn->prepare("UPDATE hospital_vaccines SET stock_available = stock_available + ? WHERE hospital_id = ? AND vaccine_id = ?");
        $updateQuery->bind_param("iii", $stock_available, $hospital_id, $vaccine_id);
        $updateQuery->execute();
    } else {
        $insertQuery = $conn->prepare("INSERT INTO hospital_vaccines (hospital_id, vaccine_id, stock_available) VALUES (?, ?, ?)");
        $insertQuery->bind_param("iii", $hospital_id, $vaccine_id, $stock_available);
        $insertQuery->execute();
    }

    header("Location: ../route/vaccines.php");
    exit();
} else {
    header("Location: add_vaccine.php");
    exit();
}
?>
