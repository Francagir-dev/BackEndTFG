<?php 
 include 'ConexionDB.php';

$sessionDuration =$_POST["SessionDuration"];
$sessionCode = $_POST["SessionCode"];

$sql = "UPDATE session set duration = '" . $sessionDuration . "' WHERE sessionCode = '" . $sessionCode . "' ";

$result = $conn->query($sql);
if($result===TRUE)
    echo "Success";
else
    echo "Error";
?>