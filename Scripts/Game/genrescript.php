<?php

class Genre{
    static function getRandomGenre()
    {
        require '../connectToDatabase.php';

        $GenreArray = $conn->query("SELECT * FROM GENRE")->fetchAll();
        foreach ($conn->query("SELECT * FROM GENRE") as $row) {
            //$GenreArray[] .= $row['GENREID'] . ";". $row['GENREDESCRIPTOR'];
        }
        $min = 0;
        $max = count($GenreArray)-1;
        $randomNumber = rand($min, $max);
        $categoryToReturn = array();
        $categoryToReturn[0] .= $GenreArray[$randomNumber]['GENREID'];
        $categoryToReturn[1] .= $GenreArray[$randomNumber]['GENREDESCRIPTOR'];
        return $categoryToReturn;
    }
    
    static function getAllGenres()
    {
        require '../connectToDatabase.php';
        $toReturn = array();
        foreach ($conn->query("SELECT * FROM GENRE") as $entry) {
            $toReturn[] .= $entry['GENREID'] . ";". $entry['GENREDESCRIPTOR'];
        }
        return $toReturn;
    }

    /*static function getRandomQuestionFromGenre($genreID, $difficultyID){
        require '../connectToDatabase.php';
        $fromDatabase = array();
        foreach ($conn->query("SELECT * FROM QUESTIONDATA WHERE GENRE = " . $genreID . " AND DIFFICULTY = " . $difficultyID) as $entry) {
            $fromDatabase[] .= $entry[0] . "; " . $entry[1] . "; " . $entry[2] . "; " . $entry[3];
        }
        $min = 0;
        $max = count($fromDatabase)-1;
        $randomNumber = rand($min, $max);
        $toReturn = $fromDatabase[$randomNumber];
        return $toReturn;
    }*/
}
?>