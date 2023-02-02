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
    echo "<div align='center'>Choose Genre</div>";
    $s = "<table align =\"center\" border= \"1\" cellpadding=\"10\" cellspacing=\"0\"><thead><tr>";
    foreach ($conn->query('SELECT * FROM genre') as $r) {
        for ($i = sizeof(array_keys($r)); $i > 0; $i--) {
            if (is_numeric(array_keys($r)[$i]))
                continue;
            $s .= "<th>" . array_keys($r)[$i] . "</a></th>";
        }
        break;
    }
    $s .= "</tr></thead><tbody>";
    foreach ($conn->query("SELECT * FROM genre") as $r) {
        $s .= "<tr>";
        for ($i = 0; $i < sizeof(array_map('htmlentities', $r)); $i++) {
            if (is_numeric(array_keys($r)[$i]))
                continue;
            $s .= "<td>" . array_values($r)[$i] . "</td>";
        }
        $s .= "</tr>";
    }
    $s .= "</tbody></table>";
    echo $s;
    ?>
</body>
</html>