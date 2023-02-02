<?php

/*Call this Script for API Request*/

    require 'genrescript.php';
    foreach(Genre::getAllGenres() as $entry){
        print_r($entry);
        echo $entry['GENREDESCRIPTOR'];
    }

?>