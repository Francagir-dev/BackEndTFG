<?php

include 'ConexionDB.php';

//Variables submitted by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];


$sqlQuery = "SELECT ID, password FROM specialist WHERE username = '". $loginUser . "'";

$result = $conn->query($sqlQuery);

if($result->num_rows>0){
   while($row = $result->fetch_assoc()){
       if($row["password"] == $loginPass){       
         echo $row["ID"];
       }else{
        echo "Error 401";
       }
   }  
}else{
   echo "Error 404";
}
$conn->close();
?>