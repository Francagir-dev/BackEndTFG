<?php 
include 'auth.php';
include 'ConexionDB.php';

// TODO: Revisar si este endpoint es necesario o está reemplazado por InsertSession.php/UpdateSession.php


$specialistID = verifyToken();


    $genre = $_POST["genre"]??null ;
    $age = $_POST["age"]??null;
    $userLocation = $_POST["userLocation"]??null;
    $phobiaLevel = $_POST["phobiaLevel"]??null;
    $symptoms = $_POST["symptoms"]??null;
    $HRV = $_POST["HRV"]??null;
    $duration = $_POST["duration"]??null;
    $actualDate = date("Y-m-d H:i:s");

    if(!$genre ||!$age ||!$userLocation ||!$phobiaLevel ||!$symptoms ||!$HRV || !$duration ){
        http_response_code(400);
        echo json_encode(["error" => "Hay algún dato no válido o falta alguno"]);
        exit;
    }

    $sqlQuery = "INSERT INTO sessionInfo (genre, age, userLocation, phobiaLevel, symptoms, HRV, duration, date)   VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $conn -> prepare($sqlQuery);
       
    if(!$stmt){
        http_response_code(500);
        echo json_encode (["Error"=> "Error por parte del servidor, intente de nuevo"]);
         exit;
    }
    
    $stmt -> bind_param("sisisids", $genre,$age,$userLocation,$phobiaLevel,$symptoms,$HRV,$duration, $actualDate); 
    $stmt -> execute();
    
    if ($stmt->affected_rows > 0) {
        http_response_code(201);
        echo json_encode(["success" => "Se ha introducido correctamente"]); // ← json_encode
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo insertar"]);
    }   
    $stmt -> close();
    $conn -> close();
?>