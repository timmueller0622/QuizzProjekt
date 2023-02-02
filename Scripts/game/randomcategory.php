<?php

/*Call this Script for API Request*/

try{
    require 'choosecategory/categoryscript.php';
    $script = new Category();
    $out = $script->getRandomCategory();

    echo 
    '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>randomcategory</title>
    </head>
    <body> 
    Random Category: ' . $out;
    
    echo '</body>
    </html>';
} catch (Exception $e){
    echo $e;
}

?>