<?php
    session_start();
    require '../connectToDatabase.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>In API einloggen</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            //http://quizzteam2.jedimasters.net
        ?>
        <form action="loginAPI.php" method="post">
            <table align ="center" border= "1" cellpadding="10" cellspacing="0">
                <tr>
                    <td>Nutzername:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Passwort:</td>
                    <td><input type ="password" name="pass"></td>
                </tr>
            </table>
            <p align="center"><input type="submit" name="login" value="login"></a></button></p>
        </form>
        <?php
            require 'connectToDatabase.php';
            if (isset($_POST['login'])){
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $sql = "SELECT * FROM player WHERE Username = '" . $name . "'";
                foreach($conn->query($sql) as $r){
                    if ($r['Passwort'] == $pass){
                        $_SESSION["username"] = $name;
                        header('Location: playerAnzeigen .php');
                    }
                }
                echo "Falsche Daten!";
            }
            /*$sql = oci_parse($conn, 'select * from admin.test');
            oci_execute($sql);
            while ($row = oci_fetch_assoc($sql)) {
            echo $row['BEZEICHNUNG'] . "<br>";*/
        ?>
    </body>
</html>