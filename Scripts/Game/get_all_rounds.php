<?php

/*Call this Script for API Request*/

require 'roundscript.php';

$output = "";
//$rounds = Round::getAllRounds();
    
if($rounds != NULL){
    foreach($answers as $current){
        $rounds .= $current . "<br>";
    }
}
else{
    $rounds = "Keine Runden gefunden.";
}

echo $rounds;

?>