<?php
class QuestionData{
    static function getQuestionFromSettings($roundid){
        require '../connectToDatabase.php';
        print_r($roundid);
        $settingid = $conn->query("SELECT genre, difficulty FROM roundsetting 
        JOIN round on round.settingid = roundsetting.settingid
        WHERE round.roundid =" . $roundid)->fetchAll()[0];
        $genreID = $settingid['GENRE'];
        $difficultyID = $settingid['DIFFICULTY'];
        $toReturn = array();
        foreach($conn->query("SELECT * FROM QUESTIONDATA
        WHERE GENRE = " . $genreID .
        "AND DIFFICULTY =" . $difficultyID) as $entry){
            $toReturn[] .= $entry['QUESTIONDATAID'] . ";" . $entry['QUESTIONDESCRIPTION'];
        }
        return $toReturn;
    }
  
    static function getAnswersFromQuestion($questionID){
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