<?php
require_once '../../config.php';

if (isset($_GET['vaccine_id'])) {
    $vaccine_id = $_GET['vaccine_id'];

    if (is_numeric($vaccine_id)) {

        $query = $conn->prepare("DELETE FROM vaccines WHERE vaccine_id = ?");
        $query->bind_param("i", $vaccine_id);

        if ($query->execute()) {
            header("Location: ../route/vaccines.php?message=Vaccine deleted successfully");
            exit();
        } else {
            echo "Error: " . $query->error;
        }
    } else {
        echo "Invalid vaccine ID.";
    }
} else {
    echo "Vaccine ID not provided.";
}
?>
