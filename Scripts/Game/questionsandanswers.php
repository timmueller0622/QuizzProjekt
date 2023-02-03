<?php

class QuestionData{
  
    public static function getAnswersFromQuestion($questionID){
        require '../connectToDatabase.php';
        $toReturn = array();
        foreach($conn->query("SELECT QUESTION, ANSWERID, ANSWERDESCRIPTION, ISRIGHT 
        FROM QUESTIONDATA JOIN ANSWERDATA ON QUESTIONDATA.QUESTIONDATAID = ANSWERDATA.QUESTION 
        WHERE QUESTIONDATAID =" . $questionID) as $entry){
            $toReturn[] .= $entry['ANSWERID'] . ";" . $entry['ANSWERDESCRIPTION'] . ";" . $entry['ISRIGHT'] . ";" . $entry['QUESTION'] . ";|" ;

        }
        return $toReturn;        
    }

}

?>