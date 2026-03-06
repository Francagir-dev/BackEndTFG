<?php 
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
define('JWT_SECRET', 'p22A!s07@13_phobia_treatment_vr_2022_secret_key');

function verifyToken(){
 $headers = getallheaders();

 if(!isset($headers['Authorization'])){
    http_response_code(401);
    echo json_encode(["error" => "Token no proporcionado"]);
    exit;
 }
 $token = str_replace('Bearer ','', $headers['Authorization']);
 try{
    $decoded = JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
     return $decoded->specialistID;
 }
 catch(Exception $e){
    http_response_code(401);
        echo json_encode(["error" => "Token inválido o expirado"]);
        exit;
 }

}
?>