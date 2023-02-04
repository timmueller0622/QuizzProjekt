<?php
class QuestionData{
    public static function getQuestionFromSettings($genreID, $difficultyID){
        require '../connectToDatabase.php';
        $toReturn = array();
        foreach($conn->query("SELECT * FROM QUESTIONDATA
        WHERE GENRE =" . $genreID .
        "AND DIFFICULTY=" . $difficultyID) as $entry){
            $toReturn[] .= $entry['QUESTIONDATAID'] . ";" . $entry['QUESTION'];
        }
        return $toReturn;
    }
  
    public static function getAnswersFromQuestion($questionID){
        require '../connectToDatabase.php';
        $toReturn = array();
        foreach($conn->query("SELECT * FROM ANSWERDATA
        WHERE QUESTION=" . $questionID) as $entry){
            $toReturn[] .= $entry['ANSWERID'] . ";" . $entry['ANSWERDESCRIPTION'];
        }
        return $toReturn;
    }
}
?>