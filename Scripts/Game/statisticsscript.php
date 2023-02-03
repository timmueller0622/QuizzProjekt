<?php

class Statistics{

    public static function getStatisticForPlayer($playerID){
        require '../connectToDatabase.php';

        $toReturn = array();

        foreach($conn->query("SELECT * FROM MATCHHISTORY WHERE PLAYERID = ". $playerID) as $entry){
            $toReturn += $entry;
        }

        return $toReturn;     
    }
}

?>