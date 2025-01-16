<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $doses_required = $_POST['doses_required'];
    $recommended_age = $_POST['recommended_age'];
    $status = $_POST['status'];

    if (!empty($name) && !empty($doses_required) && !empty($status)) {

        $query = $conn->prepare("INSERT INTO vaccines (name, description, doses_required, recommended_age, status) 
                                 VALUES (?, ?, ?, ?, ?)");

        $query->bind_param("ssiss", $name, $description, $doses_required, $recommended_age, $status);

        if ($query->execute()) {
            header("Location: ../route/vaccines.php?message=New vaccine added successfully - {$name}");
            exit();
        } else {
            echo "Error: " . $query->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    header("Location: ../view/add_vaccine.php");
    exit();
}
?>
