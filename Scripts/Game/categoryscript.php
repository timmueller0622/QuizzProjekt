<?php

class Category{
    static function getRandomCategory()
    {
        echo "test1";
        try{
            echo "test1+";
            require '../../connectToDatabase.php';
            echo "test1++";
        } catch (Exception $e){
            print_r($e);
        }
        echo "test2";
        $GenreArray = array();
        echo "test3";
        foreach ($conn->query("SELECT * FROM GENRE;") as $row) {
            echo "test4";
            $GenreArray[] .= $row;
        }
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