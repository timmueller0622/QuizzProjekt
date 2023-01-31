<?php

/*Call this Script for API Request*/

    //require 'choosecategory/categoryscript.php';
    echo "chooseCategory link succsessfully established";

    $out = Category::getRandomCategory();

    echo "Random Category: " . $out;
?>