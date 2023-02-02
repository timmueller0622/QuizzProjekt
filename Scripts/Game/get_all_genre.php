<?php

/*Call this Script for API Request*/

    require 'genrescript.php';
    $genres = Genre::getAllGenres();
    print_r($genres);
    foreach($genres as $current){
        print_r($current);
        echo $current['GENREDESCRIPTOR'];
    }

?>