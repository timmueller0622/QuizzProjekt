<?php
class Difficulty{

    static function getAllDifficulties(){

        require '../connectToDatabase.php';
    
        $toReturn = array();
    
        foreach ($conn->query("SELECT * FROM GENRE") as $entry) {
            $toReturn[] .= $entry['DIFFICULTYID'] . ";". $entry['DIFFICULTYDESCRIPTOR'] . ";|<br>";
        }
    
        return $toReturn;

    }



}

?>