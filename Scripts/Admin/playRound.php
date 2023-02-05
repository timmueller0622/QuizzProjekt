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
    echo explode(';', $question[0])[1];
    ?>
</body>
</html>