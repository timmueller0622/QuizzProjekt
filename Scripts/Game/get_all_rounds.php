<?php

/*Call this Script for API Request*/

    require 'roundscript.php';

    $output = "";
    $rounds = Round::getAllRounds();
    if(count($rounds) > 0){
        foreach($answers as $current){
            $rounds .= $current . "<br>";
        }
    }

    if($rounds == ""){
        $rounds = "Keine Runden gefunden.";
    }
    echo $rounds;

?>