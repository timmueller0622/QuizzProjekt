<?php
    //connect.php
    try{
            $conn = oci_connect("quizzteam2", "QuizzApp9755", "quizzapp_high");
        if (!$conn){
            echo "\nFAILURE: Couldn't connect to oracle.<br>";
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        } else {
            echo "<br>SUCCESS: Connected to Oracle!";
        }
    }
    catch (Exception $e){
        echo $e -> getMessage();
    }
    //oci_close($conn);
?>