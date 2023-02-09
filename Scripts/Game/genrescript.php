<?php
class Genre{
    static function getRandomGenre()
    {
        require '../connectToDatabase.php';
        $GenreArray = $conn->query("SELECT * FROM GENRE")->fetchAll();
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
}
?>