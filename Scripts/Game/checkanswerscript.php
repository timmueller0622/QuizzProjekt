<?php
class Answer
{

    public static function check_answer_is_correct($questionid)
    {
        require '../connectToDatabase.php';

        $answerid = $conn->query("SELECT answerdata.answerid FROM answerdata
        JOIN questiondata ON questiondata.questiondataid = answerdata.question
        JOIN question ON questiondata.questiondataid = question.questiondataid
        WHERE question.questionid =" . $questionid)->fetchAll()[0][0];

        $answer = $conn->query("SELECT * FROM answerdata WHERE answerid = " . $answerid)->fetchAll()[0];
        if ($answer['ISRIGHT'] == 1) {
            /* true equals 1 in database*/
            $conn->query("UPDATE TABLE question SET question.answeredcorrectly = 1 WHERE questionid=" . $questionid);
            return array('ANSWER' => array('ANSWERID' => $answer['ANSWERID'], 'ISRIGHT' => true, 'QUESTIONDATAID' => $answer['QUESTIONDATAID']));
        } else {
            return array('ANSWER' => array('ANSWERID' => $answer['ANSWERID'], 'ISRIGHT' => false, 'QUESTIONDATAID' => $answer['QUESTIONDATAID']));
        }
    }
}
?>