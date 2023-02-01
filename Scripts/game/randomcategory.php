<?php

/*Call this Script for API Request*/
//require 'choosecategory/categoryscript.php';

function getRandomCategory(){
    require '../../connectToDatabase.php';
    
    $GenreArray = array();
    $pos = 0;

    foreach($conn->query("SELECT * FROM Genre") as $row){
        
        $GenreArray[$pos] += $row;
        $pos++;

    }

    $min = 0;
    $max = 3;/*sizeof($GenreArray)*/
    $randomNumber = rand($min, $max);
    $categoryToReturn = $GenreArray($randomNumber);

    return "Methodenaufruf erfolgreich";//$categoryToReturn;
}

$out = getRandomCategory();

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

?>