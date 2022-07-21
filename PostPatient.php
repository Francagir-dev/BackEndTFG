<?php 
    include 'ConexionDB.php';
  //Variables  
  $patientName = $_POST["patientName"];    
  $patientGenre = $_POST["patientGenre"];
  $patientAge = $_POST["patientAge"];   
  $patientAnxietyLevel = $_POST["patientAnxietyLVL"];
  $patientPhobia = $_POST["patientPhobia"];
  $patientLocation = $_POST["patientLocation"];
  $specialistID = $_POST["specialistID"];
 
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