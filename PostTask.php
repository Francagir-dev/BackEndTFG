<?php 
include 'ConexionDB.php';
include 'auth.php';

$specialistID = verifyToken();

$sessionID = $_POST["sessionID"]?? null;
$description = $_POST["description"]?? null;
$anxietyLvlTask = $_POST["anxietyLvlTask"]?? null;
$duration =   $_POST["duration"]?? null;
$patientFeels =   $_POST["patientFeels"]?? null;


if(!$sessionID || !$description  || !$anxietyLvlTask ||!$duration || !$patientFeels){
  http_response_code(500);
  echo json_encode(["error"=> "Falta algún dato"]);
  exit;
}

$sqlAddItem = "INSERT INTO tasks (sessionID, description, anxietyLevelTask, duration, patientFeels)   VALUES (?,?,?,?,?)";
$stmt = $conn -> prepare($sqlAddItem);

  if(!$stmt){
    http_response_code();
   echo json_encode(["error"=> "Error en el servidor"]);
    exit;
  }
$stmt -> bind_param("issds",$sessionID, $description , $anxietyLvlTask,  $duration, $patientFeels );
$stmt -> execute();

if ($stmt->affected_rows > 0) {
    http_response_code(201);
    echo json_encode(["success" => "Se ha introducido correctamente"]);
} else {
    http_response_code(400);
    echo json_encode(["error" => "No se pudo insertar"]);
}

$stmt->close();
$conn->close();

?>