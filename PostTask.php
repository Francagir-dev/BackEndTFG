<?php 
include 'ConexionDB.php';

$sessionID = $_POST["sessionID"];
$description = $_POST["description"];
$anxietyLvlTask = $_POST["anxietyLvlTask"];
$duration =   $_POST["duration"];
$patientFeels =   $_POST["patientFeels"];

$sqlAddItem = "INSERT INTO tasks (sessionID, description, anxietyLevelTask, duration, patientFeels)
   VALUES ('".$sessionID."', '".$description."','".$anxietyLvlTask."','".$duration."','".$patientFeels."')";
 $result = $conn -> query($sqlAddItem);

echo $result;
?>