<?php 

//APP VARIABLES
$newAnxietyLvL = $_POST["aAnxietyLvl"];
$phobia = $_POST["aPhobia"];
$enviornment = $_POST["aEnviornment"];
$timeSession = $_POST["aTimeSession"];


$oculusAnxietyLvL = $newAnxietyLvL;
$oculusPhobia = $phobia;
$oculusEnviornment = $enviornment;
$oculusSession = $timeSession;


//Oculus VARIABLES
$oculusAnxietyLvL = $_GET["gAnxietyLvl"];
$oculusPhobia = $_GET["gPhobia"];
$oculusEnviornment = $_GET["gEnviornment"];
$oculusSession = $GET["gTimeSession"];

?>