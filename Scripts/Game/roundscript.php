<?php

class Round{

    static function getQuestionsFromRound($roundID){
        
        require '../connectToDatabase';
        $back = array();
        foreach($conn->query("SELECT * FROM QUESTIONDATA JOIN QUESTION ON QUESTIONDATA.QUESTIONDATAID = QUESTION.QUESTIONID WHERE ROUNDID =" . $roundID) as $row){
            $back[] .= $row['QUESTIONID'] . ";" . $row['ANSWERDCORRECTLY'] . ";" . $row['QUESTIONDESCRIPTION'];
        }
        return $back;
    }


}


?>