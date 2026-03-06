<?php 
include 'ConexionDB.php';
include 'auth.php';

$signUpUser = $_POST["signUpUser"] ?? null;
$signUpPass =  $_POST["signUpUser"] ?? null; 
$signUpMail = $_POST["signUpMail"] ?? null;

    if (!$signUpUser || !$signUpPass || !$signUpMail) {
        http_response_code(400);
        echo json_encode(["error" => "Faltan campos obligatorios"]);
        exit;
    }

$signUpPass = password_hash($signUpPass, PASSWORD_BCRYPT);

$sqlSignUp = "INSERT INTO specialist (username, password, email) VALUES (?,?,?)";

$stmt = $conn -> prepare($sqlSignUp);

    if(!$stmt){
        http_response_code(500);
        echo json_encode(["error" => "Error del servidor"]);
        exit; 
    }

$stmt -> bind_param("sss",$signUpUser, $signUpPass, $signUpMail);   

$stmt -> execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => "Registrado correctamente"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo registrar"]);
}
 $stmt -> close();
 $conn -> close();
?>