<?php 

    include 'ConexionDB.php';

    $sesionCode = $_POST["codeSession"];

    $sqlQuery = "SELECT session.ID as SessionID, session.sessionCode as SessionCode, session.idPatientSpecialist as SessionIDSP, 
    patienthasspecialists.patientID as PatientID, patient.name as PatientName, patient.phobia as PatientPhobia, patient.anxietyLVL as PhobiaLevel   
      FROM session 
      INNER JOIN patienthasspecialists ON session.idPatientSpecialist = patienthasspecialists.ID
      INNER JOIN patient ON patienthasspecialists.patientID = patient.ID
      where sessionCode = '".$sesionCode."'
      GROUP BY session.sessionCode, patienthasspecialists.patientID";

    $result = $conn->query($sqlQuery);

if($result->num_rows>0){
   $rows = array();
   while($row = $result->fetch_assoc()){
       $rows[] = $row;
   }    
   echo json_encode($rows);
}else{
   echo "Error 404";
}
$conn->close();

?>