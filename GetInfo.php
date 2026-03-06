<?php 
    include 'ConexionDB.php';
      
    $sqlQuery = "SELECT * FROM patient";
    $stmt = $conn -> prepare($sqlQuery);


    //Verifica la creación de la consulta.
  if(!$stmt){
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
    exit;
  }

  $stmt-> execute();
  $result = $stmt -> get_result();



    if($result->num_rows>0){
        $rows  = [];
    while($row = $result->fetch_assoc())
    {
       $rows[] = $row;     
    }
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
    }else{
        http_response_code(404);
        echo json_encode(["error"=> "No hay pacientes"]);
    }


$stmt -> close();
$conn -> close();

?>