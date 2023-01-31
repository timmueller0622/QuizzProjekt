<?php

/*Call this Script for API Request*/

    require 'choosecategory/categoryscript.php';

    $out = Category::getRandomCategory();

    echo "Random Category: " . $out;
?>