<?php

class QuestionData{
  
    public static function getQuestionWithAnswers($questionID){
        require '../connectToDatabase.php';
        $toReturn = array();
        echo "vor der Schleife";
        foreach($conn->query("SELECT QUESTION, ANSWERID, ANSWERDESCRIPTION, ISRIGHT 
        FROM QUESTIONDATA JOIN ANSWERDATA ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION 
        WHERE QUESTIONDATAID =" . $questionID) as $entry){
            echo "entry";
            $toReturn[] .= $entry['ANSWERID'] . ";" . $entry['ANSWERDESCRIPTION'] . ";" . $entry['ISRIGHT'] . ";" . $entry['QUESTION'] . ";|" ;

        }
        echo "nach der Schleife";
        return $toReturn;        
    }

}

?>