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
    <!-- Form um sich einzuloggen-->
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
    require '../User/userLogin.php';
    if (isset($_POST['login'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        if (LoginUser::proofLoginData($pass, $name) === false){
            echo LoginUser::echoWrongLoginData($pass, $name);
        }
        else{
            $_SESSION["username"] = $name;
            header('Location:playerAnzeigen.php');
        }
    }
    ?>
</body>

</html>