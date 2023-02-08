<?php

/*Call this Script for API Request*/

    require 'genrescript.php';
    print json_encode(Genre::getRandomGenre()); 

?>