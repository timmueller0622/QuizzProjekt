<?php
class QuestionData{
    static function getQuestion($questionid){
        require '../connectToDatabase.php';
        $sqlQuestion = "SELECT question.questiondataid, questiondescription FROM question
        JOIN questiondata ON question.questiondataid = questiondata.questiondataid
        WHERE questionid = " . $questionid;
        $question = $conn->query($sqlQuestion)->fetchAll()[0];
        $answers = QuestionData::getAnswersFromQuestion($questionid);
        $toReturn = array(
                    'QUESTION' => array(
                        'QUESTIONID' => $questionid,
                        'QUESTIONDATAID' => $question['QUESTIONDATAID'], 
                        'QUESTIONDESCRIPTION' => $question['QUESTIONDESCRIPTION']
                        ),
                    'ANSWER1' => array(
                        'ANSWERID' => $answers[0]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[0]['ANSWERDESCRIPTION'],
                        'ISRIGHT' => $answers[0]['ISRIGHT']
                        ),
                    'ANSWER2' => array(
                        'ANSWERID' => $answers[1]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[1]['ANSWERDESCRIPTION'],
                        'ISRIGHT' => $answers[1]['ISRIGHT']
                        ),
                    'ANSWER3' => array(
                        'ANSWERID' => $answers[2]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[2]['ANSWERDESCRIPTION'],
                        'ISRIGHT' => $answers[2]['ISRIGHT']
                        ),
                    'ANSWER4' => array(
                        'ANSWERID' => $answers[3]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[3]['ANSWERDESCRIPTION'],
                        'ISRIGHT' => $answers[3]['ISRIGHT']
                        )
                    );
        return $toReturn;
    }
  
    static function getAnswersFromQuestion($questionid){
        require '../connectToDatabase.php';
        $sql = "SELECT answerid, answerdescription, isright FROM question
            JOIN questiondata ON question.questiondataid = questiondata.questiondataid
            JOIN answerdata ON questiondata.questiondataid = answerdata.question
            WHERE question.questionid=" . $questionid;
        $toReturn = $conn->query($sql)->fetchAll();
        return $toReturn;
    }
    
    static function getQuestionsFromSettings($roundid){
        require '../connectToDatabase.php';
        $settingid = $conn->query("SELECT genre, difficulty FROM roundsetting 
            JOIN round on round.settingid = roundsetting.settingid
            WHERE round.roundid =" . $roundid)->fetchAll()[0];
        $genreID = $settingid['GENRE'];
        $difficultyID = $settingid['DIFFICULTY'];
        $toReturn = $conn->query("SELECT * FROM questiondata
            WHERE genre = " . $genreID .
            "AND difficulty =" . $difficultyID)->fetchAll();
        return $toReturn;
    }
}
?>