<?php

class Answer{

    public static function check_answer_is_correct($answerID){
        require '../connectToDatabase.php';

        $QuestionAnswerdRight = $conn -> query("SELECT ISRIGHT FROM ANSWERDATA WHERE ANSWERID = " . $answerID)->fetchAll()[0];
        if($QuestionAnswerdRight == 1){
            /* true equals 1 in database*/
            /*$conn -> query("UPDATE TABLE QUESTION SET QUESTION.AnsweredCorrectly = 1 WHERE QuestionDataID in 
                            ( SELECT QUESTIONDATAID FROM QUESTIONDATA JOIN ANSWERDATA 
                                ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION WHERE ANSWERDATA.ANSWERID = " . $answerID .")");*/
            return true;
        }
        else{
            /* false equals 0 in database*/
            /*$conn -> query("UPDATE TABLE QUESTION SET QUESTION.AnsweredCorrectly = 0 WHERE QuestionDataID in 
                            ( SELECT QUESTIONDATAID FROM QUESTIONDATA JOIN ANSWERDATA 
                                ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION WHERE ANSWERDATA.ANSWERID = " . $answerID .")");*/
            return false;
        }

    }

}

?>