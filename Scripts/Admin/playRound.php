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
    <title>Runde spielen</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // http://quizzteam2.jedimasters.net/Scripts
    require 'navi.php';
    require '../Game/questionsandanswers.php';
    require '../Game/roundscript.php';
    require '../Game/creategame.php';
    echo "roundid: " . $_SESSION['roundid'];
    $qpr = Round::getQuestionsPerRound($_SESSION['roundid']);
    $qArray = Game::createQuestions($qpr, $_SESSION['roundid']);
    $question = QuestionData::getQuestionFromSettings($_SESSION['roundid']);
    $qnum = rand(0, sizeof($question));

    $s = '<div align="center">';
    $s .= explode(';', $question[$qnum])[1] . '<br>';
    $answers = QuestionData::getAnswersFromQuestion(explode(';', $question[$qnum])[0]);
    foreach($answers as $answer){
        $s .= explode(';', $answer)[1] . '<br>';
    }
    $s .= '</div>';
    echo $s;
    ?>
</body>
</html>