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
    require '../connectToDatabase.php';
    require '../Game/genrescript.php';
    $s = "<div align='center'><label for=\"genre\">Choose a genre: </label>";
    $s .= "<select name='genre' id='genre'>";
    $genres = Genre::getAllGenres();
    foreach($genres as $genre) {
        $s .= "<option value=\"" . $genre . "\">" .  
            $genre . "</option>";
    }
    $s .= "</select></div>";

    $s .= "<div align='center'><label for=\"difficulty\">Choose a difficulty: </label>";
    $s .= "<select name='difficulty' id='difficulty'>";
    $genres = $conn->query("SELECT difficultydescriptor FROM difficulty")->fetchAll();
    for ($i = 0; $i < sizeof($genres); $i++) {
        $s .= "<option value=\"" . $genres[$i]['DIFFICULTYDESCRIPTOR'] . "\">" .  
            $genres[$i]['DIFFICULTYDESCRIPTOR'] . "</option>";
    }
    $s .= "</select></div>";
    echo $s;
    ?>
</body>

</html>