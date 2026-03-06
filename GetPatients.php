<?php 
include 'ConexionDB.php';
include 'auth.php';

$specialistID = verifyToken();

//Variables submitted by user
if (!isset($_POST["ID"]) || !is_numeric($_POST["ID"])) {
    http_response_code(400);
    echo json_encode(["error" => "Error, no se ha introducido en el formato adecuado"]);
    exit;
}

$patientID = (int) $_POST["ID"];
$sqlQuery = "SELECT p.* FROM patient p 
             INNER JOIN patienthasspecialists phs ON p.ID = phs.patientID 
             WHERE p.ID = ? AND phs.specialistID = ?";
$stmt = $conn -> prepare($sqlQuery);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
}

$stmt->bind_param("ii", $patientID, $specialistID);
$stmt -> execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    $rows = array();
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }    
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(404);
    echo json_encode(["error" => "Paciente no encontrado"]);
}
$stmt->close();
$conn->close();
?>
