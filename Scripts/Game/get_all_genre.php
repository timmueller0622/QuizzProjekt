<?php

/*Call this Script for API Request*/

    require 'genrescript.php';
    foreach(Genre::getAllGenres() as $entry){
        echo $entry['GENREDESCRIPTOR'];
    }

?>