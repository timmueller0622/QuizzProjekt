<?php

echo 
'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>randomcategory</title>
</head><body>';

/*Call this Script for API Request*/
        require 'choosecategory/categoryscript.php';
        $out : string = Category::getRandomCategory();
    
        echo "Random Category: " //. $out;
;
echo "</body></html>";

?>