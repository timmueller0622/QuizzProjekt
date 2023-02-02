<?php

class Category{
    static function getRandomCategory()
    {
        require '../connectToDatabase.php';

        $GenreArray = array();
        foreach ($conn->query("SELECT * FROM GENRE") as $row) {
            print_r($row);
            $GenreArray[] .= $row;
        }
        $min = 0;
        $max = count($GenreArray);
        $randomNumber = rand($min, $max);
        //echo "random works";
        print_r($GenreArray);
        $categoryToReturn = $GenreArray[$randomNumber];
        print_r($categoryToReturn[0]);
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