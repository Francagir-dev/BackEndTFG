<?php 
include 'ConexionDB.php';
include 'auth.php';

$specialistID = verifyToken();
$sessionID = $_POST["SessionID"] ?? null;
$itemSeen = $_POST["itemName"]?? null;
$duration = $_POST["duration"]?? null;
$distanceToPlayer = $_POST["distance"]?? null;
$manytimesSeen = $_POST["manyTimes"]?? null;

  if(!$sessionID||!$itemSeen||!$duration
    ||!$distanceToPlayer ||!$manytimesSeen){
    http_response_code(400);
    echo json_encode(["error"=> "Falta algun campo"]);
    exit;
  }

$sqlAddItem = "INSERT INTO itemseen (sessionID, itemSeen, duration, distanceToPlayer, manyTimesSeen) VALUES (?, ?, ?, ?, ?)";
$stmt -> prepare ($sqlAddItem);
if(!$stmt){
   http_response_code(500);
    echo json_encode(["error"=> "Error en el servidor"]);
    exit;
}
$stmt -> bind_param("isffi",$sessionID , $itemSeen ,$duration, $distanceToPlayer, $manytimesSeen);
$result = $stmt -> $execute();

 if($result<0){
  http_response_code(201);
 echo json_decode(["OK" => "Se ha introducido correctamente"]);
 }
 
?> 