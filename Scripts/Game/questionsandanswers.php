<?php

class QuestionData{
  
    public static function getQuestionWithAnswers($questionID){
        require '../connectToDatabase.php';
        $toReturn = array();

        foreach($conn->query("SELECT * FROM QUESTIONDATA JOIN ANSWERDATA ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION 
                                GROUP BY QUESTIONDATAID WHERE QUESTIONDATAID = " . $questionID . ";") as $entry){

            $toReturn[] .= $entry['ANSWERID'] . ";" . $entry['ANSWERDESCRIPTION'] . ";" . $entry['ISRIGHT'] . ";" . $entry['QUESTION'] . ";|" ;

        }

        return $toReturn;        
    }

}

?>