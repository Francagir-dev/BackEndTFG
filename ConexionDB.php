<?php
$servername = "localhost";
$username = "francagir";
$password = "0!dri-ilxP@faIMc";
$dbname = "phobiatreatmentvr";

//Create Con
$conn = new mysqli($servername,$username,$password,$dbname);

    //Check Connection
    if($conn-> connect_error)
        die("Connection Failed: " . $conn->connect_error);

?>