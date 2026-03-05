<?php 

include 'ConexionDB.php';

    if (!isset($_POST["signUpUser"]) || !isset($_POST["signUpPass"]) || !isset($_POST["signUpMail"])) {
        http_response_code(400);
        echo json_encode(["error" => "Faltan campos obligatorios"]);
        exit;
    }
$signUpUser = $_POST["signUpUser"];
$signUpPass = password_hash( $_POST["signUpPass"];, PASSWORD_BCRYPT);
$signUpMail = $_POST["signUpMail"];

$sqlSignUp = "INSERT INTO specialist (username, password, email) VALUES (?,?,?)";

$stmt = $conn -> prepare($sqlSignUp);
    if(!$stmt){
        http_response_code(500);
        echo json_encode(["error" => "Error del servidor"]);
        exit; 
    }
$stmt -> bind_param("sss",$signUpUser, $signUpPass, $signUpMail);   
$stmt -> exectue();
if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => "Registrado correctamente"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo registrar"]);
}
 echo ($result);
?>