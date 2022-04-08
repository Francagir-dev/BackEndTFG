<?php 

    $servername = "localhost";
    $username = "franca";
    $password = "@7)s2_!Oyzm5UMt[";
    $dbname = "SessionInfo";
    //Create Con
    $conn = new mysqli( $servername,$username,$password,$dbname);
    
    $sessionData = $_POST["sessionDataJson"];
     
    // Decoding json 
    $sessionDecoded = json_decode($sessionData);

    //Desencrypt (?)
    $method = 'aes-256-cbc';

    $iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

    $decrypt = function ($valor) use ($method, $clave, $iv) {
        $encrypted_data = base64_decode($valor);
        return openssl_decrypt($valor, $method, $clave, false, $iv);
    };

    $getIV = function () use ($method) {
        return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)))
    };

    //Desencrypted JSON
    $sessionDecrypted =  $decrypt($sessionDecoded);
   

    SetValues($sessionDecrypted);

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




    function SetValues($sessionDecrypted){
       //Assign Values
       $genre = $sessionDecrypted -> genre;
       $age =  $sessionDecrypted -> age;
       $phobiaLevel = $sessionDecrypted -> phobiaLevel;
       $symptoms =  $sessionDecrypted -> symptoms;
       $HRV =  $sessionDecrypted -> HRV;
       $duration =  $sessionDecrypted -> durationSession;
       $date = .date("dd-M-YY H:i:s");
        


?>