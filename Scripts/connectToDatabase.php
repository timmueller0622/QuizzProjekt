<?php
    //connect.php
    echo "\ntestconnectenter";
    try {
        $pdo = new PDO('oracle:host=quizzteam2.jedimasters.net;dbname=Team2','opc','QuizzApp9755');
    } catch (Exception $e){
        echo ($e);
    }
    echo "\ntestconnectreturn";
?>