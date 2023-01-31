<?php

/*Call this Script for API Request*/

    require '/choosecategory/categoryScript.php';

    $out = Category::getRandomCategory();

    echo "Random Category: " . $out;
?>