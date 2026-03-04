<?php 

include 'ConexionDB.php';

//Variables submitted by user

$patientID = $_POST["patientID"];


$sqlQuery = "SELECT * FROM patient WHERE ID = ?";
$stmt = $mysqli -> prepare($sqlQuery);
$stmt ->

$result = $statement -> execute();

if($result->num_rows>0){
    $rows = array();
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }    
    echo json_encode($rows);
}else{
    echo "Error 404";
}

$conn->close();
?>