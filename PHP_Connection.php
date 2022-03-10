<?php 

    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "databasename"

    //Create Con
    $conn = new mysqli( $servername,$username,$password,$dbname);
    
    //Check Connection
    if($conn-> connect_error)
        die("Connection Failed: " . $conn->connect_error)

    echo "Connected Succesfully";
   
    $sqlQuery = "SELECT id, genre, age, userlocation, phobiaLevel, symptoms, HRV FROM users";
    
    $result = $conn->query($sql);

    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            echo "id: " .$row["id"].  " -Genre: " .$row["genre"].  " -age: " .$row["age"].  " -location: " .$row["userlocation"].  " -phobialevel: " .$row["phobiaLevel"]. 
             " -symptoms: " .$row["symptoms"].  " -HRV: " .$row["HRV"]. "<br>";
        
        }
    }else{
        echo "0 results"
    }
$conn -> close();
?>