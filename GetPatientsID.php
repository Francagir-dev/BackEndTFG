<?php 

include 'ConexionDB.php';
include 'auth.php';

// Verificar token y obtener el ID del especialista autenticado
$specialistID = verifyToken();

// Obtener todos los pacientes del especialista autenticado
$sqlQuery = "SELECT patientID FROM patienthasspecialists WHERE specialistID = ?";
$stmt = $conn->prepare($sqlQuery);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
}

$stmt->bind_param("i", $specialistID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode(["error" => "No se han encontrado pacientes"]);
}

$stmt->close();
$conn->close();
?>