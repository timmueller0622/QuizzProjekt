<?php

class Statistics{

    static function getMatchHistory($playerID){
        require '../connectToDatabase.php';
        $toReturn = array();
        $matchH = $conn->query("SELECT * FROM matchhistory WHERE playerid = ". $playerID)->fetchAll();
        return $matchH;
    }
}

?>