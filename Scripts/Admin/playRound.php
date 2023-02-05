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
    echo "test1";
    require '../Game/creategame.php';
    echo "test2";
    require '../Game/questionsandanswers.php';
    //Game::createGame();
    echo "test3";
    echo $_POST['GENRE'] . $_POST['DIFFICULTY'];
    $question = QuestionData::getQuestionFromSettings($_POST['GENRE'], $_POST['DIFFICULTY']);
    echo "test4";
    ?>
</body>
</html>