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
    
    $s = '<div align="center">';

    $qpr = Round::getQuestionsPerRound($_SESSION['roundid']);
    $qArray = Game::createQuestions($qpr, $_SESSION['roundid']);
    print_r($qArray);
    echo "<br>";
    foreach($qArray as $question){
        print_r($question);
        echo QuestionData::getQuestion($question['QUESTIONID']);
        $aArray = QuestionData::getAnswersFromQuestion($question['QUESTIONID']);
        print_r($aArray);
        echo "<br>";
    }

    $answers = QuestionData::getAnswersFromQuestion(explode(';', $question[$qnum])[0]);
    foreach($answers as $answer){
        $s .= explode(';', $answer)[1] . '<br>';
    }
    $s .= '</div>';
    echo $s;
    ?>
</body>
</html>