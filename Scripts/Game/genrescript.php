<?php

class Genre{
    static function getRandomGenre()
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
    
    static function getAllGenres()
    {
        require '../connectToDatabase.php';
    
        $toReturn = array();
    
        foreach ($conn->query("SELECT * FROM GENRE") as $entry) {
            $toReturn[] .= $entry['GENREDESCRIPTOR'];
        }
    
        return $toReturn;
    }

    static function getRandomQuestionFromGenre($genreID, $difficultyID){
        require '../connectToDatabase.php';
        echo "Database works.";
        $fromDatabase = array();
        echo "fromdatabase initialisation works.";
        foreach ($conn->query("SELECT * FROM QUESTIONDATA WHERE GENRE = " . $genreID . " AND DIFFICULTY = " . $difficultyID) as $entry) {
            echo "loop call";
            $fromDatabase[] .= $entry;
            echo "loop save";
        }

        echo "min max variables";
        $min = 0;
        $max = count($fromDatabase)-1;
        echo "random number generator";
        $randomNumber = rand($min, $max);

        echo "to Return";
        $toReturn = $fromDatabase[$randomNumber];
    
        echo "return now!";
        return $toReturn;
    }
}
?>