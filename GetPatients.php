<?php 
include 'ConexionDB.php';

//Variables submitted by user
if (!isset($_POST["patientID"]) || !is_numeric($_POST["patientID"])) {
    http_response_code(400);
    echo json_encode(["error" => "Error, no se ha introducido en el formato adecuado"]);
    exit;
}

$patientID = (int) $_POST["patientID"];
$sqlQuery = "SELECT * FROM patient WHERE patientID = ?";
$stmt = $conn -> prepare($sqlQuery);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
}

$stmt->bind_param("i", $patientID);
$statement -> execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    $rows = array();
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }    
    echo json_encode($rows);
}else{
    http_response_code(404);
    echo json_encode(["error" => "Paciente no encontrado"]);
}
$stmt->close();
$conn->close();
?>
