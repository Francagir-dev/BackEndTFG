<?php 
    include 'ConexionDB.php';
    include 'auth.php';

    $specialistID = verifyToken();
    

   //Variables enviadas por la app
    $duration = 0.0;
    $phobiaFaced = $_POST["phobiaPatient"]?? null;
    $anxietyLvLFaced= $_POST["anxietyLvLPatient"]?? null;
    $sessionCode = $_POST["sessionCode"]?? null;
    $patientID = (int) $_POST["patientID"]?? null;    
    $actualDate =  date("Y-m-d H:i:s")?? null;
   if (!$phobiaFaced || !$anxietyLvLFaced || 
       ! $sessionCode || !$patientID) {
      http_response_code(400);
      echo json_encode(["error" => "Faltan campos obligatorios"]);
    exit;
}
    $sqlGetPatientSpecialist = "SELECT * FROM patienthasspecialists WHERE patientID = ? AND specialistID = ?";
    $stmt = $conn->prepare($sqlGetPatientSpecialist);
 
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
}

$stmt -> bind_param("ii", $patientID, $specialistID);
$stmt -> execute();
$result = $stmt->get_result();

 if($result->num_rows>0){
   $row = $result-> fetch_assoc();
   $patientSpecialistID = $row["ID"];
   $sqlAddSession = "INSERT INTO session (idPatientSpecialist, Date, duration, phobiaFaced, anxietyLevelFaced, sessionCode) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlAddSession);
 
   if (!$stmtInsert) {
        http_response_code(500);
        echo json_encode(["error" => "Error del servidor"]);
        exit;
    }
    $stmtInsert->bind_param("isdsss", $patientSpecialistID, $actualDate, $duration, $phobiaFaced, $anxietyLvLFaced, $sessionCode);
    $stmtInsert->execute();

     if ($stmtInsert->affected_rows > 0) {
        echo json_encode(["success" => "Sesión creada correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo crear la sesión"]);
    }

    $stmtInsert->close();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Relación paciente-especialista no encontrada"]);
}

  //Cerramos conexión
  $stmt -> close();
  $conn->close();
?>