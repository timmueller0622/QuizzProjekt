<?php
session_start();
if (!isset($_SESSION["username"]))
    header('Location: loginAPI.php');
if (isset($_POST['sub'])) {
    require '../User/userModify.php';
    require '../connectToDatabase.php';
    $oldpass = $conn->query('SELECT * FROM player WHERE playerid = ' . $_GET['id'])->fetchAll()[0]['USERPASSWORD'];
    if (ModifyUser::modifyUserEmail($_GET['id'], $oldpass, $_POST['EMAIL']) &&
        ModifyUser::modifyUserUsername($_GET['id'], $oldpass, $_POST['USERNAME']) &&
        ModifyUser::modifyUserPasswd($_GET['id'], $oldpass, $_POST['USERPASSWORD']))
    {
        header('Location:playerAnzeigen.php');
    }
    else 
        echo "error";
} // $_POST['sub']
?>

<!doctype html>
<html>

<head>
    <title>Player Modifizieren</title>
    <meta charset="utf-8">
    <link href="layout.css" rel="stylesheet">
</head>

<body>
    <form method="post">
        <?php
        require 'navi.php';
        require '../connectToDatabase.php';
        if (isset($_GET['id'])) {
            $sql = "SELECT * FROM player WHERE PLAYERID = " . $_GET['id'];
            $s = "";
            $s .= "<table align =\"center\" border= \"1\" cellpadding=\"10\" cellspacing=\"0\">";
            $s .= "<thead><tr><th>Data</th><th>Wert</th><th>Modifizierung</th></tr></tr></thead><tbody>";
            foreach ($conn->query($sql) as $r) {
                for ($i = 2; $i < sizeof(array_keys($r)) - 4; $i++) {
                    if (is_numeric(array_keys($r)[$i]))
                        continue;
                    $s .= "<tr><td>" . array_keys($r)[$i] . "</td>";
                    $s .= "<td>" . array_values($r)[$i] . "</td>";
                    $s .= "<td><input name=\"" . array_keys($r)[$i] . "\"></td></tr>";
                }
                $s .= "<td></td><td></td><td><input type=\"submit\" name=\"sub\" value=\"Speichern\"></td>";
            }
            $s .= "</tbody></table>";
            echo $s;
        } // $_POST['sub']
        ?>
    </form>
</body>

</html>