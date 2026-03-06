<?php 
    include 'ConexionDB.php';

  
  $specialistID = verifyToken();
  
    //Variables  
  $patientName = $_POST["patientName"]?? null;    
  $patientGenre = $_POST["patientGenre"]?? null;
  $patientAge = $_POST["patientAge"]?? null;   
  $patientAnxietyLevel = $_POST["patientAnxietyLVL"]?? null;
  $patientPhobia = $_POST["patientPhobia"]?? null;
  $patientLocation = $_POST["patientLocation"]?? null;

 
  //Insertamos paciente
  $sqlAddPatient = "INSERT INTO patient (name, genre, age, anxietyLevel, phobia, Location)   VALUES ('".$patientName."', '".$patientGenre."','".$patientAge."','".$patientAnxietyLevel."','".$patientPhobia."','".$patientLocation."')";
  $result = $conn -> query($sqlAddPatient);
  //pillamos su ID
  $sqlGetLastPatient = "SELECT ID FROM patient ORDER BY ID DESC LIMIT 1";
  $newResult = $conn->query($sqlGetLastPatient);
  //Si hay pacientes
  if($newResult->num_rows>0){
    while($row = $newResult->fetch_assoc()){   
      //Añadimos a tabla intermediaria
      $sqlAddToNewTable =  "INSERT INTO patienthasspecialists (patientID ,specialistID) VALUES ('".$row["ID"]."', '".$specialistID."')";
      $lastResult = $conn->query($sqlAddToNewTable);
    }
  }
  //Cerramos conexión
  $conn->close();
  ?>