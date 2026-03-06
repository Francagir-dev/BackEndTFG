<?php 
    include 'ConexionDB.php'; //Class containing all DB info

    $sesionCode = $_POST["codeSession"]; //Variable that will receive info from the app

    $sqlQuery = "SELECT session.ID as SessionID, session.sessionCode as SessionCode, session.idPatientSpecialist as SessionIDSP, 
    patienthasspecialists.patientID as PatientID, patient.name as PatientName, patient.phobia as PatientPhobia, patient.anxietyLVL as PhobiaLevel   
      FROM session 
      INNER JOIN patienthasspecialists ON session.idPatientSpecialist = patienthasspecialists.ID
      INNER JOIN patient ON patienthasspecialists.patientID = patient.ID
      where sessionCode = ?
      GROUP BY session.sessionCode, patienthasspecialists.patientID"; //Query that will return info from different tables (Session, patienthasspecialists, patient, specialist)

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
$stmt -> close();
$conn->close();

?>
