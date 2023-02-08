<?php
session_start();
require '../connectToDatabase.php';
if (!isset($_SESSION["username"])) {
    header('Location: loginAPI.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Genre Auswählen</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // http://quizzteam2.jedimasters.net/Scripts
    require 'navi.php';
    require '../Game/questionsandanswers.php';
    require '../Game/roundscript.php';
    $qpr = Round::getQuestionsPerRound($_SESSION['roundid']);
    echo $qpr;
    $s = '<div align="center"><form method="post" action="playRound.php">
    <input type="submit">';
    $qnum = rand(0, sizeof($question));
    for ($i=0; $i < $qpr; $i++) { 
        $question = QuestionData::getQuestionFromSettings($_SESSION['roundid']);
        $s .= explode(';', $question[$qnum])[1] . '<br>';
        $answers = QuestionData::getAnswersFromQuestion(explode(';', $question[$qnum])[0]);
        foreach($answers as $answer){
            $s .= '<input type="radio" name="answer" id=' . explode(';', $question[$qnum])[1];
            $s .= explode(';', $answer)[1] . '<br>';
        }
    }
    $s .= '</form></div>';
    echo $s;
    ?>
</body>
</html>