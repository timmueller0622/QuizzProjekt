<?php
class Setting{
    static function getRandomGenre()
    {
        require '../connectToDatabase.php';
        //get array of all entries in genre table
        $genreArray = $conn->query("SELECT * FROM genre")->fetchAll();
        $min = 0; //minimum genre array index
        $max = count($GenreArray)-1; //maximum genre array index
        $randomNumber = rand($min, $max); //generate random number between the two
        //create formatted array of random entry in genre table
        $toReturn = array('GENRE' =>
            array('GENREID' => $genreArray[$randomNumber]['GENREID'], 
            'GENREDESCRIPTOR' => $genreArray[$randomNumber]['GENREDESCRIPTOR'])
        );
        return $toReturn;
    }
    
    static function getAllGenres()
    {
        require '../connectToDatabase.php';
        //get array of all entries in genre table
        $genreArray = $conn->query("SELECT * FROM genre")->fetchAll();
        $toReturn = array();
        //counter to iterate over returning array
        $i = 0;
        foreach($genreArray as $r){
            //temporary array which formats entries in genre table
            $temp = array('GENREID' => $r[1], 'GENREDESCRIPTOR' => $r[0]);
            //add formatted to returning array as entry and increment counter
            $toReturn[$i] = $temp;
            $i++;
        }
        return $toReturn;
    }
    static function getAllDifficulties(){
        require '../connectToDatabase.php';
        //get array of all entries in difficulty table
        $diffArray = $conn->query("SELECT * FROM difficulty")->fetchAll();
        $toReturn = array();
        //counter to iterate over returning array
        $i = 0;
        foreach($diffArray as $r){
            //temporary array which formats entries in difficulty table
            $temp = array('DIFFICULTYID' => $r[1], 'DIFFICULTYDESCRIPTOR' => $r[0]);
            //add formatted to returning array as entry and increment counter
            $toReturn[$i] = $temp;
            $i++;
        }
        return $toReturn;
    }
}
?>