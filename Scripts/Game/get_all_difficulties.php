<?php

/*Call this Script for API Request*/

    require 'difficultyscript.php';
    print_r(json_encode(Difficulty::getAllDifficulties()))

?>