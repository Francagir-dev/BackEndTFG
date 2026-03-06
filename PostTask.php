<?php 
include 'ConexionDB.php';
include 'auth.php';

$specialistID = verifyToken();

$sessionID = $_POST["sessionID"]?? null;
$description = $_POST["description"]?? null;
$anxietyLvlTask = $_POST["anxietyLvlTask"]?? null;
$duration =   $_POST["duration"]?? null;
$patientFeels =   $_POST["patientFeels"]?? null;

$sqlAddItem = "INSERT INTO tasks (sessionID, description, anxietyLevelTask, duration, patientFeels)
   VALUES ('".$sessionID."', '".$description."','".$anxietyLvlTask."','".$duration."','".$patientFeels."')";
 $result = $conn -> query($sqlAddItem);

echo $result;
?>