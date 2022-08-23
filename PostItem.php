<?php 

include 'ConexionDB.php';

$SessionID = $_POST["sessionID"];          
$ItemSeen = $_POST["itemName"];       
$Duration = $_POST["duration"];     
$DistanceToPlayer = $_POST["distance"]; 
$ManytimesSeen =$_POST["manyTimes"];     

$sqlAddItem = "INSERT INTO itemsseen (sessionID, itemSeen, duration, distanceToPlayer, manyTimesSeen)
   VALUES ('".$SessionID."', '".$ItemSeen."','".$Duration."','".$DistanceToPlayer."','".$ManytimesSeen."')";
 $result = $conn -> query($sqlAddItem);

 
 echo $result;


?> 