<?php

class Category{

    public static function getRandomCategory() : string{
        require '../../connectToDatabase.php';
        echo "succsess connectToDatabase";
        
        $GenreArray = array();
        $pos = 0;

        foreach($conn->query("SELECT * FROM Genre") as $row){
            
            $GenreArray[$pos] += $row;
            $pos++;

        }

        $min : int = 0;
        $max : int = 3;/*sizeof($GenreArray)*/
        $randomNumber : int = 1 //rand($min, $max);
        //$categoryToReturn = $GenreArray[$randomNumber];*/

        //return $categoryToReturn;
        return "test";
    }
/*
    public static function getAllCategories(){
        require '../../connectToDatabase.php';

        $toReturn = array();

        foreach($conn->query("SELECT * FROM Genre") as $entry){
            $toReturn += $entry;
        }*/
/*
        return $toReturn;
    }

*/
}

?>