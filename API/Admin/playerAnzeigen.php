<?php
    session_start();
    require '../connectToDatabase.php';
    if (!isset($_SESSION["username"])){
        header('Location: loginAPI.php');
    }
    if(isset($_GET['id'])){
        $sql = "DELETE FROM nutzer WHERE ID = " . $_GET['id'];
        $pdo->query($sql);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Player anzeigen</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            //http://localhost/php/
            require 'navi.php';
            require '../connectToDatabase.php';
            $s = "<table align =\"center\" border= \"1\" cellpadding=\"10\" cellspacing=\"0\"><thead><tr>";
            foreach($pdo->query('SELECT * FROM nutzer') as $r) {
                for ($i=0; $i < sizeof(array_keys($r)); $i++) { 
                    if (is_numeric(array_keys($r)[$i]))
                        continue;
                    $s .= "<th><a href=\"?orderby=" . array_keys($r)[$i] . "\">" . array_keys($r)[$i] . "</a></th>";
                }
                $s .= "<th>" . "Delete" . "</th>";
                $s .= "<th>" . "Modify" . "</th>";
                break;
            }
            $s .= "</tr></thead><tbody>";
            $sql = "SELECT * FROM nutzer";
            if (isset($_GET['orderby'])){
                $sql .= " ORDER BY " . $_GET['orderby'];
            }
            foreach($pdo->query($sql) as $r) {
                $s .= "<tr>";
                for ($i=0; $i < sizeof(array_map('htmlentities', $r)); $i++) {
                    if (is_numeric(array_keys($r)[$i]))
                        continue;
                    $s .= "<td>" . array_values($r)[$i] . "</td>";
                }
                $s .= "<td><a href=\"playerAnzeigen.php?id=" . $r['ID'] . "\">Delete</a></td>";
                $s .= "<td><a href=\"playerBearbeiten.php?id=" . $r['ID'] . "\">Modify</a></td>";
                $s .= "</tr>";
            }
            $s .= "</tbody></table>";
            echo $s;
        ?>
    </body>
</html>