<?php
require '../../config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hospital_id'])) {
    $hospitalId = intval($_POST['hospital_id']);
    
    $query = "
        SELECT v.vaccine_id, v.name, hv.stock_available 
        FROM hospital_vaccines hv
        JOIN vaccines v ON hv.vaccine_id = v.vaccine_id
        WHERE hv.hospital_id = ? AND v.status = 'Available'
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $hospitalId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $vaccines = [];
    while ($row = $result->fetch_assoc()) {
        $vaccines[] = [
            "vaccine_id" => $row['vaccine_id'],
            "name" => $row['name'],
            "out_of_stock" => $row['stock_available'] <= 0
        ];
    }
    
    if (!empty($vaccines)) {
        echo json_encode([
            "status" => "success",
            "data" => $vaccines
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No vaccines available for the selected hospital."
        ]);
    }
    exit;
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request. Please provide a valid hospital ID."
    ]);
    exit;
}
?>
