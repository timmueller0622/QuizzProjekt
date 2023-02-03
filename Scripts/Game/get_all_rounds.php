<?php

/*Call this Script for API Request*/

    require 'roundscript.php';

    $output = "";
    $answers = Round::getAllRounds();
    foreach($answers as $current){
        $output .= $current . "<br>";
    }

    if($output == ""){
        $output = "Keine Runden gefunden.";
    }
    echo $output;

?>