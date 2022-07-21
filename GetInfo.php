<?php 

    include 'ConexionDB.php';
    


    /*
    $sqlQuery = "SELECT id, genre, age, userlocation, phobiaLevel, symptoms, HRV FROM SessionInfo";
    $sqlQuery = "SELECT id, genre, age, userlocation, phobiaLevel, symptoms, duration FROM SessionInfo";
    */
    $sqlQuery = "SELECT * FROM patient";
    

    $result = $conn->query($sqlQuery);
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
            " - Date: " .$row["date"];
        }
    }else{
        echo "Error 404";
    }
/*
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            echo "id: " .$row["id"].  " -Genre: " .$row["genre"].  " -age: " .$row["age"].  " -location: " .$row["userlocation"].  " -phobialevel: " .$row["phobiaLevel"]. 
             " -symptoms: " .$row["symptoms"].  " -Duration: " .$row["duration"]. "<br>";
        }
    }else{
        echo "0 results"
    }
*/


$conn -> close();

?>