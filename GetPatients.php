<?php

include 'ConexionDB.php'

//Variables submitted by user
//$loginUser = $_POST["loginUser"];
//$loginPass = $_POST["loginPass"];
$patientID = $_POST["patientID"];


$sqlQuery = "SELECT name, age, genre, location, anxietyLvL, phobia FROM patient WHERE ID = '". $patientID . "'";

$result = $conn->query($sqlQuery);

if($result->num_rows>0){
    $rows = array();
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }
    echo json_encode($rows);
}else{
    echo "-1";
}
$conn->close();
?>