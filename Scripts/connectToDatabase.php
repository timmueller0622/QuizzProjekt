<?php
    //connect.php

    try {
        echo "test";
        $conn = new PDO("oci:dbname=quizzapp_high", "quizzteam2", "QuizzApp9755");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connected to database<br>';

   } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
   }

?>