<?php 
    session_start();
    require '../connectToDatabase.php';
    if (!isset($_SESSION["username"])){
        header('Location: ../Admin/loginAPI.php');
    }

    class LoginUser{
        public static function proofLoginData($passwd, $username){
            require '../connectToDatabase.php';
            $dataToProof = $conn -> query("SELECT * WHERE Username = " . $username . ";");
            if($dataToProof['USERPASSWORD'] == $passwd){
                return $dataToProof['PLAYERID'];
            }
            else{ return false;}
        }
        public static function echoWrongLoginData($inputPasswd, $inputUsername) : void{
            echo "<font color='red'> Logindaten ungültig. Es wurde versucht sich mit </font><font color='red'>" 
                . $inputUsername . " und dem Password </font><font color='red'>" 
                . $inputPasswd . " einzuloggen.</font>";
        }
    }
?>