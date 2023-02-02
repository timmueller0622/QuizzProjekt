<?php

class Statistics{

    public static function getStatisticForPlayer($playerID){
        require '../connectToDatabase.php';

        $toReturn = array();

        foreach($conn->query("SELECT * FROM MatchHistory WHERE PlayerID = ". $playerID . ";") as $entry){
            $toReturn += $entry;
        }

        return $toReturn;     
    }
}

?>