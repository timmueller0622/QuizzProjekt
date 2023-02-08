<?php
class Difficulty{
    static function getAllDifficulties(){
        require '../connectToDatabase.php';
        $GenreArray = $conn->query("SELECT * FROM DIFFICULTY")->fetchAll();
        $toReturn = array();
        $i = 0;
        foreach($GenreArray as $r){
            $temp = array('DIFFICULTYID' => $r[1], 'DIFFICULTYDESCRIPTOR' => $r[0]);
            $toReturn[$i] = $temp;
            $i++;
        }
        return json_encode($toReturn);
    }
}

?>