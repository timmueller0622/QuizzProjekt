<?php
    echo "test";
    session_start();
    require '../connectToDatabase.php';
    if(isset($_GET['id'])){
        $sql = "DELETE FROM nutzer WHERE ID = " . $_GET['id'];
        $pdo->query($sql);
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>In API einloggen</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            //http://localhost/php/
        ?>
        <form action="nutzerlogin.php" method="post">
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
            require 'connect.php';
            if (isset($_POST['login'])){
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $sql = "SELECT * FROM nutzer WHERE Username = '" . $name . "'";
                foreach($pdo->query($sql) as $r){
                    if ($r['Passwort'] == $pass){
                        $_SESSION["username"] = $name;
                        header('Location: nutzeranzeigen.php');
                    }
                }
                echo "Falsche Daten!";
            }
        ?>
    </body>
</html>