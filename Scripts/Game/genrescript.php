<?php

class Genre{
    static function getRandomGenre()
    {
        require '../connectToDatabase.php';

        $GenreArray = $conn->query("SELECT * FROM GENRE")->fetchAll();
        $min = 0;
        $max = count($GenreArray)-1;
        $randomNumber = rand($min, $max);
        print_r($conn->query("SELECT genreid FROM genre where genredescriptor='Gaming'")->fetchAll()[0][0]);
        $categoryToReturn = array('GENREID' => $GenreArray[$randomNumber]['GENREID'], 'GENREDESCRIPTOR' => $GenreArray[$randomNumber]['GENREDESCRIPTOR']);
        print_r($categoryToReturn);
        return $categoryToReturn;
    }
    
    static function getAllGenres()
    {
        require '../connectToDatabase.php';
        $GenreArray = $conn->query("SELECT * FROM GENRE")->fetchAll();
        $toReturn = array();
        $i = 0;
        foreach($GenreArray as $r){
            $temp = array('GENREID' => $r[1], 'GENREDESCRIPTOR' => $r[0]);
            $toReturn[$i] = $temp;
            $i++;
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