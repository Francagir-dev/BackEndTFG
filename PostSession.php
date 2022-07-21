<?php 
    include 'ConexionDB.php';

    //variables
   
    $duration = 0.0;
    $phobiaFaced = $_POST["phobiaPatient"];
    $anxietyLvLFaced= $_POST["anxietyLvLPatient"];
    $sessionCode = $_POST["sessionCode"];

    $patientID = $_POST["patientID"];  
    $SpecialistID = $_POST["specialistID"];
    $actualDate =  date("Y-m-d H:i:s");
    $sqlGetPatientSpecialist = "SELECT * FROM patienthasspecialists WHERE patientID = '".$patientID."' AND specialistID = '".$SpecialistID."'";
    $patientSpecialist = $conn->query($sqlGetPatientSpecialist);
 

 if($patientSpecialist->num_rows>0){
    while($row = $patientSpecialist->fetch_assoc()){  
    $sqlAddPatient = "INSERT INTO Session (idPatientSpecialist, Date, duration, phobiaFaced, anxietyLevelFaced, sessionCode) VALUES 
                    ('".$row["ID"]."', '".$actualDate."','".$duration."','".$phobiaFaced."','".$anxietyLvLFaced."','".$sessionCode."')";
       $result = $conn -> query($sqlAddPatient);
        echo $result;
    }
  }

  //Cerramos conexión
  $conn->close();
?>