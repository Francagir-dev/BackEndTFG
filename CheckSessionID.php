<?php 

    include 'ConexionDB.php';

    $sesionCode = $_POST["sessionID"];

    $sqlQuery = "SELECT idPatientSpecialist FROM session where sessionCode = '".$sesionCode."'";

    $result = $conn->query($sqlQuery);

if($result->num_rows>0){
   while($row = $result->fetch_assoc()){
            echo $row["idPatientSpecialist"];
       }  
}else{
   echo "Unknown Error";
}
$conn->close();

?>