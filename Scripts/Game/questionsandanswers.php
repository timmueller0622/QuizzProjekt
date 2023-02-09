<?php
class QuestionData{
    static function getQuestion($questionid){
        require '../connectToDatabase.php';
        $sqlQuestion = "SELECT questiondataid, questiondescription FROM question
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
                        'ANSWERDESCRIPTION' => $answers[0]['ANSWERDESCRIPTION']
                        ),
                    'ANSWER2' => array(
                        'ANSWERID' => $answers[1]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[1]['ANSWERDESCRIPTION']
                        ),
                    'ANSWER3' => array(
                        'ANSWERID' => $answers[2]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[2]['ANSWERDESCRIPTION']
                        ),
                    'ANSWER4' => array(
                        'ANSWERID' => $answers[3]['ANSWERID'],
                        'ANSWERDESCRIPTION' => $answers[3]['ANSWERDESCRIPTION']
                        )
                    );

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
    
    static function getQuestionFromSettings($roundid){
        require '../connectToDatabase.php';
        echo 'test2<br>';
        $settingid = $conn->query("SELECT genre, difficulty FROM roundsetting 
        JOIN round on round.settingid = roundsetting.settingid
        WHERE round.roundid =" . $roundid)->fetchAll()[0];
        echo 'test3<br>';
        $genreID = $settingid['GENRE'];
        $difficultyID = $settingid['DIFFICULTY'];
        $toReturn = $conn->query("SELECT * FROM QUESTIONDATA
            WHERE GENRE = " . $genreID .
            "AND DIFFICULTY =" . $difficultyID)->fetchAll()[0];
            echo 'test4<br>';
        return $toReturn;
    }
}
?>