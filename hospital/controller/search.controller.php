<?php
$searchTerm = $_GET['query'] ?? '';

include_once("../../config.php");

$searchTerm = $conn->real_escape_string($searchTerm);

$query = "
    (
        SELECT 
            'Hospital' AS category,
            hospital_id AS id,
            name AS title,
            address AS details,
            city,
            state,
            country,
            NULL AS dosesRequired,
            NULL AS recommendedAge,
            NULL AS vaccineStatus
        FROM hospitals
        WHERE name LIKE '%$searchTerm%'
    )
    UNION
    (
        SELECT 
            'Vaccine' AS category,
            vaccine_id AS id,
            name AS title,
            description AS details,
            NULL AS city,
            NULL AS state,
            NULL AS country,
            doses_required AS dosesRequired,
            recommended_age AS recommendedAge,
            status AS vaccineStatus
        FROM vaccines
        WHERE name LIKE '%$searchTerm%'
    )
";

$result = $conn->query($query);

$resultsArray = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $resultsArray[] = $row;
    }
} else {
    $resultsArray[] = ['error' => 'No results found'];
}

echo json_encode($resultsArray);

$conn->close();
?>
