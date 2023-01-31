<?php

/*Call this Script for API Request*/

$out = "test";
//$out = Category::getRandomCategory();

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

require 'choosecategory/categoryscript.php';

echo '</body>
</html>';

?>