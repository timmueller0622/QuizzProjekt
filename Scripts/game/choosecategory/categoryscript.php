<?php

class Category{

    static function getRandomCategory(){
        try{
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
        //$categoryToReturn = $GenreArray($randomNumber);

        return "Methodenaufruf erfolgreich";//$categoryToReturn;
        } catch (Exception $e){
            echo $e;
        }
        
    }
/*
    static function getAllCategories(){
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