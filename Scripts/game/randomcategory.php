<?php

/*Call this Script for API Request*/

    try{
        require 'choosecategory/categoryscript';

        $out = Category::getRandomCategory();
    
        echo "Random Category: " . $out;
    }
    catch(Exception e){
        echo e;
    }

?>