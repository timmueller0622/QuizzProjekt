<?php

/*Call this Script for API Request*/

    require 'choosecategory/categoryscript';

    $out = Category::getRandomCategory();

    echo "Random Category: " . $out;
?>