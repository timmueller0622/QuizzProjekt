<?php

class Answer{

    public static function proofAnswerAndSave($answerID) : void {
        require '../../connectToDatabase.php';

        $QuestionAnswerdRight = $conn -> query("SELECT IsRight FROM AnswerData WHERE AnswerID = " . $answerID . ";");
        if($QuestionAnswerdRight == 1){
            /* true -> 1 in database*/
            $conn -> query("UPDATE TABLE Question SET Question.AnsweredCorrectly = 1 WHERE QuestionDataID in 
                            ( SELECT QuestionDataID FROM QuestionData JOIN AnswerData 
                                ON QuestionData.QuestionDataID = AnswerData.Question WHERE AnswerData.AnswerID = " . $answerID .");");
        }
        else{
            /* false -> 0 in database*/
            $conn -> query("UPDATE TABLE Question SET Question.AnsweredCorrectly = 0 WHERE QuestionDataID in 
                            ( SELECT QuestionDataID FROM QuestionData JOIN AnswerData 
                                ON QuestionData.QuestionDataID = AnswerData.Question WHERE AnswerData.AnswerID = " . $answerID .");");
        }

    }

    public static function getAnswersOfQuestion($questionID){
        require '../connectToDatabase.php';
        $toReturn = array($conn -> query("SELECT * FROM Question WHERE QuestionID =" . $questionID . ";"));
        return $toReturn;
    }

}

?>