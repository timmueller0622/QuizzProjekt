<?php

class Round{

    static function getQuestionsFromRound($roundID){    
        require '../connectToDatabase';
        $back = array();
        foreach($conn->query("SELECT * FROM QUESTIONDATA JOIN QUESTION ON QUESTIONDATA.QUESTIONDATAID = QUESTION.QUESTIONID WHERE ROUNDID =" . $roundID) as $row){
            $back[] .= $row['QUESTIONID'] . ";" . $row['ANSWERDCORRECTLY'] . ";" . $row['QUESTIONDESCRIPTION'] . ";|";
        }
        return $back;
    }

    static function getAllRounds(){
        require '../connectToDatabase';
        $back = array();

        echo "vor Prepare <br>";
        $toExecute = $conn -> prepare("SELECT COUNT(ROUNDID) FROM ROUND");
        echo "nach dem Prepare <br>";
        echo "vor Execute <br>";
        print_r($toExecute);
        $toExecute->execute();
        echo "nach dem Execute <br>";
        print_r($toExecute);
        $counter = ($toExecute->fetchAll(PDO::FETCH_DEFAULT))['COUNT(ROUNDID)'];
        print_r($counter);

        echo "vor der Schleife";
        if($counter > 0){
            foreach($conn->query("SELECT * FROM ROUND") as $row){
                print_r($row);
                $back[] .= $row['ROUNDID'] . ";" . $row['GAMEID'] . ";" . $row['SETTINGID'] . ";|";
            }
        }
        print_r($back);
        return $back;
    }


}


?>