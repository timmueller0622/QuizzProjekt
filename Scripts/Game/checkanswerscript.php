<?php

class Answer{

    public static function check_answer_is_correct($answerID){
        require '../connectToDatabase.php';

        $toExecute = $conn -> prepare("SELECT ISRIGHT FROM ANSWERDATA WHERE ANSWERID = " . $answerID);
        $toExecute->execute();
        $QuestionAnswerdRight = $toExecute->fetchAll(PDO::FETCH_DEFAULT);



        if($QuestionAnswerdRight[0]['ISRIGHT'] == 1){
            /* true equals 1 in database*/
            $conn -> query("UPDATE TABLE QUESTION SET QUESTION.ANSWERDCORRECTLY = 1 WHERE QUESTIONDATAID in 
                            ( SELECT QUESTIONDATAID FROM QUESTIONDATA JOIN ANSWERDATA 
                                ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION WHERE ANSWERDATA.ANSWERID = " . $answerID .")");
            return "true";
        }
        else{
            /* false equals 0 in database*/
            $conn -> query("UPDATE TABLE QUESTION SET QUESTION.ANSWERDCORRECTLY = 0 WHERE QUESTIONDATAID in 
                            ( SELECT QUESTIONDATAID FROM QUESTIONDATA JOIN ANSWERDATA 
                                ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION WHERE ANSWERDATA.ANSWERID = " . $answerID .")");
            return "false";
        }

    }

}

?>