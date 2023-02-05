<?php
session_start();
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
    require '../Game/genrescript.php';
    require '../Game/difficultyscript.php';

    $s = "<div align='center'>
        <form action='playRound.php' method='post' id='matchSettings'>
        <input type='submit'>
        </form>
        <label for='genre'>Choose a genre: </label>
        <select name='genre' id='genre' form='matchSettings'>";
    $genres = Genre::getAllGenres();
    foreach($genres as $genre) {
        $s .= "<option value='" . explode(";", $genre)[0] . "'>" .  
        explode(";", $genre)[1] . "</option>";
    }
    $s .= "</select></div>";

    $s .= "<div align='center'><label for='difficulty'>Choose a difficulty: </label>";
    $s .= "<select name='difficulty' id='difficulty' form='matchSettings'>";
    $difficulties = Difficulty::getAllDifficulties();
    foreach($difficulties as $difficulty) {
        $s .= "<option value='" . explode(";", $difficulty)[0] . "'>" .  
            explode(";", $difficulty)[1] . "</option>";
    }
    $s .= "</select>
        </div>";
    echo $s;
    ?>
</body>

</html>
