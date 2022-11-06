<?php 

    include 'ConexionDB.php'; //Class containing all DB info

    $sesionCode = $_POST["codeSession"]; //Variable that will receive info from the app

    $sqlQuery = "SELECT session.ID as SessionID, session.sessionCode as SessionCode, session.idPatientSpecialist as SessionIDSP, 
    patienthasspecialists.patientID as PatientID, patient.name as PatientName, patient.phobia as PatientPhobia, patient.anxietyLVL as PhobiaLevel   
      FROM session 
      INNER JOIN patienthasspecialists ON session.idPatientSpecialist = patienthasspecialists.ID
      INNER JOIN patient ON patienthasspecialists.patientID = patient.ID
      where sessionCode = '".$sesionCode."'
      GROUP BY session.sessionCode, patienthasspecialists.patientID"; //Query that will return info from different tables (Session, patienthasspecialists, patient, specialist)

    $result = $conn->query($sqlQuery); //Getting the result

if($result->num_rows>0){//if there is at least 1
   $rows = array(); //Array of info
   while($row = $result->fetch_assoc()){//while there is any row remaining
       $rows[] = $row;
   }    
   echo json_encode($rows);//return info 
}else{//If query don't find any
   echo "Error 404";
}
$conn->close();//Close connection

?>
