<?php

    function getRandomCategory(){

        require '../../connectToDatabase.php';
        $GenreArray = array();
        foreach($conn->query("SELECT * FROM GENRE") as $row){
            
            $GenreArray[] .= $row;

        }
        $min = 0;
        $max = count($GenreArray);
        $randomNumber = rand($min, $max);
        $categoryToReturn = $GenreArray[$randomNumber]['GENREDESCRIPTOR'];

        return $categoryToReturn;
        
    }

    function getAllCategories(){
        require '../../connectToDatabase.php';

        $toReturn = array();

        foreach($conn->query("SELECT * FROM Genre") as $entry){
            $toReturn += $entry;
        }

        return $toReturn;
    }


