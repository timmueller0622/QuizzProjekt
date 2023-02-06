<?php
class QuestionData{
    static function getQuestion($questionid){
        require '../connectToDatabase.php';
        $toReturn = array();
        foreach($conn->query("SELECT * FROM ANSWERDATA
        WHERE QUESTION=" . $questiondataid) as $entry){
            $toReturn[] .= $entry['ANSWERID'] . ";" . $entry['ANSWERDESCRIPTION'];
        }
        return $toReturn;
    }
    static function getQuestionFromSettings($roundid){
        require '../connectToDatabase.php';
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
  
    static function getAnswersFromQuestion($questionid){
        require '../connectToDatabase.php';
        $sql = "SELECT answerdescription FROM question
        JOIN questiondata ON question.questiondataid = questiondata.questiondataid
        JOIN answerdata ON questiondata.questiondataid = answerdata.question
        WHERE question.questionid=" . $questionid;
        $toReturn = $conn->query($sql)->fetchAll();
        return $toReturn;
    }
}
?>