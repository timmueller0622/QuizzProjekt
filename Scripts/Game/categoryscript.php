<?php

class Category{
    static function getRandomCategory()
    {
        require '../connectToDatabase.php';

        $GenreArray = array();
        echo "before loop";
        foreach ($conn->query("SELECT * FROM GENRE") as $row) {
            echo "inloop";
            $GenreArray[] .= $row;
        }
        echo "after loop";
        $min = 0;
        $max = count($GenreArray);
        $randomNumber = rand($min, $max);
        $categoryToReturn = $GenreArray[$randomNumber]['GENREDESCRIPTOR'];
        echo $categoryToReturn;
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