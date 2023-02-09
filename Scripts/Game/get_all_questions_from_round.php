<?php

/*Call this Script for API Request*/

    require 'roundscript.php';
    $output = "Aufruf fehlgeschlagen! Keine Parameter!";

    if(isset($_GET['roundid']))
    {   
        $output = "";
        //$answers = Round::getQuestionsFromRound($_GET['roundid']);
        foreach($answers as $current){
            $output .= $current . "<br>";
        }
    }
    echo $output;

?>