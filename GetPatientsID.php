<?php 

include 'ConexionDB.php';

$userID = "1";


 $sqlQuery = "SELECT patientID FROM Session where specialistID = '" . $userID . "'";

 $result = $conn->query($sqlQuery);


if($result->num_rows>0){
    $rows = array();
    while($row = $result->fetch_assoc()){
        $rows[] = $row;
    }
    echo json_encode($rows);
}else{
    echo "Error 404";
}

$conn-> close();
?>