<?php
class Round{

    static function getQuestionsFromRound($roundID){    
        require_once '../connectToDatabase.php';
        $back = array();
        foreach($conn->query("SELECT * FROM QUESTIONDATA JOIN QUESTION ON QUESTIONDATA.QUESTIONDATAID = QUESTION.QUESTIONID WHERE ROUNDID =" . $roundID) as $row){
            $back[] .= $row['QUESTIONID'] . ";" . $row['ANSWERDCORRECTLY'] . ";" . $row['QUESTIONDESCRIPTION'] . ";|";
        }
        return $back;
    }

    static function getAllRounds(){
        require_once '../connectToDatabase.php';
        $back = array();
        $toExecute = $conn -> prepare("SELECT COUNT(ROUNDID) FROM ROUND");
        $toExecute->execute();
        $counter = ($toExecute->fetchAll(PDO::FETCH_DEFAULT))['COUNT(ROUNDID)'];

        if($counter > 0){
            foreach($conn->query("SELECT * FROM ROUND") as $row){
                print_r($row);
                $back[] .= $row['ROUNDID'] . ";" . $row['GAMEID'] . ";" . $row['SETTINGID'] . ";|";
            }
        }
        if($back == array()){
            return NULL;
        }
        else{
            return $back;
        }
    }

    static function getQuestionsPerRound($roundid){
        require '../connectToDatabase.php';
        $qpr = $conn->query("SELECT questionsperround FROM roundsetting 
            JOIN round on round.settingid = roundsetting.settingid
            WHERE roundid =" . $roundid)->fetchAll()[0][0];
        return $qpr;
    }
}
?>