<?php
    //connect.php

    try {
        $conn = new PDO("oci:dbname=quizzapp_high", "quizzteam2", "QuizzApp9755");
        
        echo "test";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connected to database<br>';

   } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
   }

?>