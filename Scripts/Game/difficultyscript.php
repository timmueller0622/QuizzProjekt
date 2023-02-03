<?php
class Difficulty{

    static function getAllDifficulties(){

        require '../connectToDatabase.php';
    
        $toReturn = array();
    
        foreach ($conn->query("SELECT * FROM DIFFICULTY") as $entry) {
            $toReturn[] .= $entry['DIFFICULTYID'] . ";". $entry['DIFFICULTYDESCRIPTOR'] . ";|<br>";
        }
    
        return $toReturn;

    }

}

?>