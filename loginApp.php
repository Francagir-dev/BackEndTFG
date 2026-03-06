<?php
include 'ConexionDB.php';
include 'auth.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$specialistID = verifyToken();



$expireTime = 8;

if(!isset($_POST["loginUser"]) || !isset($_POST["loginPass"])) {
   http_response_code(400);
   echo json_encode(["error" => "Error, usuario o contraseña incorrecta."]);
   exit;
}
//Variables submitted by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];


$sqlQuery = "SELECT ID, password FROM specialist WHERE username = ?";
$stmt = $conn->prepare($sqlQuery);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
}

$stmt -> bind_param("s", $loginUser);
$stmt -> execute();
$result = $stmt ->get_result();

if($result->num_rows>0){
   $row = $row = $result->fetch_assoc();
      if(password_verify($loginPass, $row["password"])){
         $payload = [
            "iss" => "phobia-treatment",   // Emisor
            "iat" => time(),               // Fecha de emisión
            "exp" => time() + ($expireTime * 3600), // Expiración: 8 horas
            "specialistID" => $row["ID"]  // Dato del especialista
        ];
        $token = JWT::encode($payload, JWT_SECRET, 'HS256');
        echo json_encode(["Token"=> $token]);
      }else{
         http_response_code(401);
        echo json_encode(["error" => "Contraseña incorrecta"]);
      }
}else{
    http_response_code(404);
        echo json_encode(["error" => "Usuario no encontrado"]);
}
$stmt -> close();
$conn->close();
?>