<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>In API einloggen</title>
    <meta charset="utf-8">
</head>

<body>
    <form action="loginAPI.php" method="post">
        <table align="center" border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Nutzername:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input type="password" name="pass"></td>
            </tr>
        </table>
        <p align="center"><input type="submit" name="login" value="login"></a></button></p>
    </form>
    <?php
    require '../connectToDatabase.php';
    if (isset($_POST['login'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];

        if (proofLoginData($pass, $name)) {
            $_SESSION["username"] = $name;
            echo "Richtige Daten!";
            //header('Location: playerAnzeigen.php');
        } else {
            echo "Falsche Daten!";
        }
    }

    function proofLoginData($passwd, $username)
    {
        require '../connectToDatabase.php';
        $dataToProof = $conn->query("SELECT * WHERE username = " . $username . ";");
        print_r($dataToProof);
        if ($dataToProof['USERPASSWORD'] == $passwd) {
            return true;
        } else {
            return false;
        }
    }
    ?>
</body>

</html>