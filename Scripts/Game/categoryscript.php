<?php

class Category{
    static function getRandomCategory()
    {
        require '../connectToDatabase.php';

        $GenreArray = array();
        foreach ($conn->query("SELECT * FROM GENRE") as $row) {
            $GenreArray[] .= $row['GENREDESCRIPTOR'];
        }
        $min = 0;
        $max = count($GenreArray)-1;
        $randomNumber = rand($min, $max);
        $categoryToReturn = $GenreArray[$randomNumber];
        //print_r($GenreArray);
        return $categoryToReturn;
    }
    
    static function getAllCategories()
    {
        require '../../connectToDatabase.php';
    
        $toReturn = array();
    
        foreach ($conn->query("SELECT * FROM Genre;") as $entry) {
            $toReturn += $entry;
        }
    
        return $toReturn;
    }
}
?>