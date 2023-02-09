<?php
class Setting{
    static function getRandomGenre()
    {
        require '../connectToDatabase.php';
        $GenreArray = $conn->query("SELECT * FROM genre")->fetchAll();
        $min = 0;
        $max = count($GenreArray)-1;
        $randomNumber = rand($min, $max);
        $categoryToReturn = array('GENRE' =>
            array('GENREID' => $GenreArray[$randomNumber]['GENREID'], 
            'GENREDESCRIPTOR' => $GenreArray[$randomNumber]['GENREDESCRIPTOR'])
        );
        return $categoryToReturn;
    }
    
    static function getAllGenres()
    {
        require '../connectToDatabase.php';
        $GenreArray = $conn->query("SELECT * FROM genre")->fetchAll();
        $toReturn = array();
        $i = 0;
        foreach($GenreArray as $r){
            $temp = array('GENREID' => $r[1], 'GENREDESCRIPTOR' => $r[0]);
            $toReturn[$i] = $temp;
            $i++;
        }
        return $toReturn;
    }
    static function getAllDifficulties(){
        require '../connectToDatabase.php';
        $GenreArray = $conn->query("SELECT * FROM difficulty")->fetchAll();
        $toReturn = array();
        $i = 0;
        foreach($GenreArray as $r){
            $temp = array('DIFFICULTYID' => $r[1], 'DIFFICULTYDESCRIPTOR' => $r[0]);
            $toReturn[$i] = $temp;
            $i++;
        }
        return $toReturn;
    }
}
?>