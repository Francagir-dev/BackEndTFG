<?php 

    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "SessionInfo";
    //Create Con
    $conn = new mysqli( $servername,$username,$password,$dbname);
    
    $sessionData = $_POST["sessionDataJson"];
     
    // Decoding json 
    $sessionDecoded = json_decode($sessionData);

    //Desencrypt (?)
    $method = 'aes-256-cbc';

    $iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

    $desencriptar = function ($valor) use ($method, $clave, $iv) {
        $encrypted_data = base64_decode($valor);
        return openssl_decrypt($valor, $method, $clave, false, $iv);
    };

    $getIV = function () use ($method) {
        return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)))
    };

    //Desencrypted JSON
    $sessionDesencrypted =  $desencriptar($sessionDecoded);
   

    SetValues($sessionDesencrypted);

 //Check Connection
 if($conn-> connect_error)
     die("Connection Failed: " . $conn->connect_error)
     $sql = "INSERT INTO sessionInfo (genre, age, userLocation, phobiaLevel, symptoms, HRV, duration, date) 
      VALUES('".$genre ."',
             '" .$age ."',
             '" .$phobiaLevel ."',
             '" .$symptoms ."',
             '" .$HRV ."',
             '" .$duration ."',
             '" .$date ."')";




    function SetValues($sessionDesencrypted){
       //Assign Values
       $genre = $sessionDesencrypted -> genre;
       $age =  $sessionDesencrypted -> age;
       $phobiaLevel = $sessionDesencrypted -> phobiaLevel;
       $symptoms =  $sessionDesencrypted -> symptoms;
       $HRV =  $sessionDesencrypted -> HRV;
       $duration =  $sessionDesencrypted -> durationSession;
       $date = .date("dd-M-YY H:i:s");
        


?>