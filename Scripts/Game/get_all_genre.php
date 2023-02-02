<?php

/*Call this Script for API Request*/

    require 'genrescript.php';
    $genres = Genre::getAllGenres();
    foreach($genres as $current){
        echo $current . "<br>";
    }

?>