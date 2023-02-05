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
    require '../Game/creategame.php';
    require '../Game/questionsandanswers.php';
    //Game::createGame();
    $question = QuestionData::getQuestionFromSettings($_POST['genre'], $_POST['difficulty']);
    $qnum = rand(0, sizeof($question));
    echo $qnum;
    echo explode(';', $question[$qnum])[1];
    $answers = QuestionData::getAnswersFromQuestion(explode(';', $question[$qnum])[0]);
    foreach($answers as $answer){
        echo explode(';', $answer)[1] . '<br>';
    }
    ?>
</body>
</html>