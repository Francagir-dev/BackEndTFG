<?php 
 include 'ConexionDB.php';
 include 'auth.php';
// Verificar token
$specialistID = verificarToken();

if (!isset($_POST["SessionDuration"]) || !isset($_POST["SessionCode"]) || 
    !is_numeric($_POST["SessionDuration"])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos obligatorios"]);
    exit;
}

$sessionDuration = (float) $_POST["SessionDuration"];
$sessionCode = $_POST["SessionCode"];

// Actualizar solo sesiones que pertenezcan al especialista autenticado
$sql = "UPDATE session s
        INNER JOIN patienthasspecialists phs ON s.idPatientSpecialist = phs.ID
        SET s.duration = ?
        WHERE s.sessionCode = ? AND phs.specialistID = ?";

$stmm = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
}
$stmt -> bind_param("dsi",$sessionDuration, $sessionCode, $specialistID);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => "Sesión actualizada correctamente"]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Sesión no encontrada o no autorizada"]);
}

$stmt->close();
$conn->close();
?>