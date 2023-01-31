<?php

/*Call this Script for API Request*/
    echo "test";
    
    require '/choosecategory/categoryScript.php';

    $out = Category::getRandomCategory();

    echo "Random Category: " . $out;
?>