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
    $s = "<div align='center'><label for=\"genre\">Choose a genre: </label>";
    $s .= "<select name='genre' id='genre'>";
    $genres = $conn->query("SELECT genredescriptor FROM genre")->fetchAll();
    print_r($genres);
    for ($i = 0; $i < sizeof($genres); $i++) {
        echo "test";
        $s .= "<option value=\"" . $genres[$i]['GENREDESCRIPTOR'] . "\">" .  $genres[$i]['GENREDESCRIPTOR'] . "</option>";
    }
    $s .= "</select></div>";
    echo $s;
    ?>
</body>

</html>