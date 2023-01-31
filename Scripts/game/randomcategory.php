<?php

echo 
"<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>randomcategory</title>
</head>
<body>
";

/*Call this Script for API Request*/

    try{
        require 'choosecategory/categoryscript';

        $out = Category::getRandomCategory();
    
        echo "Random Category: " . $out;
    }
    catch(Exception e){
        echo "error";
    }



echo "</body></html>";

?>