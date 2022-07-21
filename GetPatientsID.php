<?php 

include 'ConexionDB.php';

$userID = $_POST["specialistID"];


 $sqlQuery = "SELECT patientID FROM patienthasspecialists where specialistID = '" . $userID . "'";

 $result = $conn->query($sqlQuery);


if($result->num_rows>0){
    $rows = array();
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }
    //after all array is filled
    echo json_encode($rows);
}else{
    echo "Error 404";
}

$conn-> close();
?>