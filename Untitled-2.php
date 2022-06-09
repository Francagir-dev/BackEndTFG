<?php

$servername = "localhost";
$username = "franca";
$password = "0!dri-ilxP@faIMc";
$dbname = "phobiatreatmentvr"


//Variables submitted by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];

//Create Con
$conn = new mysqli( $servername,$username,$password,$dbname);

//Check Connection
if($conn-> connect_error)
    die("Connection Failed: " . $conn->connect_error)

echo "Connected Succesfully";

$sqlQuery = "SELECT id, genre, age, userlocation, phobiaLevel, symptoms, HRV, duration FROM SessionInfo";


$result = $conn->query($sql);
$sessionData;
$json_array = array();
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        
        echo 
        " id: " .$row["id"].  
        " - Genre: " .$row["genre"].  
        " - Age: " .$row["age"].  
        " - Location: " .$row["userLocation"].  
        " - Phobia Level: " .$row["phobiaLevel"]. 
        " - Symptoms: " .$row["symptoms"].  
        " - HRV: " .$row["HRV"]. 
        " - Duration: " .$row["duration"].
        " - Date: " .$row["date"]
        "<br>";
    }
}else{
    echo "0 results"
}
?>