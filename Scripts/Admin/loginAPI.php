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
    require '../User/userLogin.php';
    if (isset($_POST['login'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];

        if (!LoginUser::proofLoginData($pass, $name)){
            echo "Falsche Daten!";
        }
        else{
            $_SESSION["username"] = $name;
            header('Location:playerAnzeigen.php');
        }
            
            

        /*$sql = "SELECT * FROM player WHERE Username = '" . $name . "'";
        foreach ($conn->query($sql) as $r) {
            if ($r['USERPASSWORD'] == $pass) {
                $_SESSION["username"] = $name;
                header('Location: playerAnzeigen.php');
            }
        }*/

        
    }

    /*function proofLoginData($passwd, $username){
        try{
            require '../connectToDatabase.php';
            $dataToProof = $conn->query("SELECT * FROM player WHERE Username = '" . $username . "'")->fetchAll()[0];
            print_r($dataToProof['USERPASSWORD'] . " " . $passwd);
            if($dataToProof['USERPASSWORD'] == $passwd){
                return true;
            }
            else{ return false;}
        } catch (Exception $e){
            echo $e;
        }
            
    }*/
    ?>
</body>

</html>