<?php
class QuestionData{
    public static function getQuestionFromSettings($genreID, $difficultyID){
        require '../connectToDatabase.php';
        $toReturn = array();
        echo "test1";
        foreach($conn->query("SELECT * FROM QUESTIONDATA
        WHERE GENRE =" . $genreID .
        "AND DIFFICULTY =" . $difficultyID) as $entry){
            echo "test2";
            $toReturn[] .= $entry['QUESTIONDATAID'] . ";" . $entry['QUESTIONDESCRIPTION'];
            echo "test3";
        }
        
        echo "test4";
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