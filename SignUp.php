<?php 

include 'ConexionDB.php';

    $signUpUser = $_POST["signUpUser"];
    $signUpPass = $_POST["signUpPass"];
    $signUpMail = $_POST["signUpMail"];

 $sqlSignUp = "INSERT INTO specialist (username, password, email) VALUES ('".$signUpUser."', '".$signUpPass."','".$signUpMail."')";
 $result = $conn -> query($sqlSignUp);
 echo ($result);
?>