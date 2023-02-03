<?php

/*Call this Script for API Request*/

    require 'difficultyscript.php';
    $genres = Difficulty::getAllDifficulties();
    foreach($genres as $current){
        echo $current;
    }

?>