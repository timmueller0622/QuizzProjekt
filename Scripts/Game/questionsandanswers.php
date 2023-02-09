<?php
class QuestionData{
    static function getQuestion($questionid){
        require '../connectToDatabase.php';
        //prepare sql statement to get questiondata as string
        $sqlQuestion = "SELECT question.questiondataid, questiondescription FROM question
            JOIN questiondata ON question.questiondataid = questiondata.questiondataid
            WHERE questionid = " . $questionid;
        //get questiondata entry as array
        $question = $conn->query($sqlQuestion)->fetchAll()[0];
        //get answers corresponding to question as array
        $answers = QuestionData::getAnswersFromQuestion($questionid);
        //format array to return
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
        //prepare sql statement as string to fetch all answers corresponding to questiondataid saved in entry corresponding to questionid
        $sql = "SELECT answerid, answerdescription, isright FROM question
            JOIN questiondata ON question.questiondataid = questiondata.questiondataid
            JOIN answerdata ON questiondata.questiondataid = answerdata.question
            WHERE question.questionid=" . $questionid;
        //save result in array to return
        $toReturn = $conn->query($sql)->fetchAll();
        return $toReturn;
    }
    
    static function getQuestionsFromSettings($roundid){
        require '../connectToDatabase.php';
        //get entry from setting table corresponding to saved setting variable in round
        $settingid = $conn->query("SELECT genre, difficulty FROM roundsetting 
            JOIN round on round.settingid = roundsetting.settingid
            WHERE round.roundid =" . $roundid)->fetchAll()[0];
        //save genre and difficulty ids in setting entry
        $genreid = $settingid['GENRE'];
        $difficultyid = $settingid['DIFFICULTY'];
        //fetch array from question data containing all questions correlating to genre and difficulty in this round's settings
        $toReturn = $conn->query("SELECT * FROM questiondata
            WHERE genre = " . $genreid .
            "AND difficulty =" . $difficultyid)->fetchAll();
        return $toReturn;
    }

    static function updateAnsweredQuestion($questionid){
        require '../connectToDatabase.php';
        $sql = "UPDATE question SET answeredcorrectly = ? WHERE questionid= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([1, $questionid]);
        $question = $conn->query("SELECT * FROM question WHERE questionid=" . $questionid)->fetchAll()[0];
        $toReturn = array(
            'QUESTION' => array(
                'QUESTIONID' => $question['QUESTIONID'],
                'QUESTIONDATAID' => $question['QUESTIONDATAID'],
                'ROUNDID' => $question['ROUNDID'],
                'ANSWEREDCORRECTLY' => $question['ANSWEREDCORRECTLY']
            )
        );
        return $toReturn;
    }
}
?>