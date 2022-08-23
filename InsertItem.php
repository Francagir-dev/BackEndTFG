<?php 
include 'ConexionDB.php';

$sessionID = $_POST["SessionID"];
$itemSeen = $_POST["itemName"];
$duration = $_POST["duration"];

$distanceToPlayer = $_POST["distance"];
$manytimesSeen = $_POST["manyTimes"];

$sqlAddItem = "INSERT INTO itemseen (sessionID, itemSeen, duration, distanceToPlayer, manyTimesSeen)
   VALUES ('".$sessionID."', '".$itemSeen."','".$duration."','".$distanceToPlayer."','".$manytimesSeen."')";
 $result = $conn -> query($sqlAddPatient);
 if($result<0)
 echo "Success";
?> 