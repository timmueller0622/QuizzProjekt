<?php

/*Call this Script for API Request*/

    require 'roundscript.php';
    echo "require works";

    $output = "";
    print_r($output . " <- output");
    $rounds = Round::getAllRounds();
    foreach($answers as $current){
        $rounds .= $current . "<br>";
    }

    if($rounds == ""){
        $rounds = "Keine Runden gefunden.";
    }
    echo $rounds;

?>