<?php

    class LoginUser{
        public static function proofLoginData($passwd, $username){
            require '../connectToDatabase.php';
            $dataToProof = $conn->query("SELECT * FROM player WHERE username = '" . $username . "'")->fetchAll()[0];
            if($dataToProof['USERPASSWORD'] == $passwd){
                return $dataToProof['PLAYERID'];
            }
            else { 
                return false;
            }
        }
        public static function echoWrongLoginData($inputPasswd, $inputUsername) : void{
            echo "<font color='red'> Logindaten ungültig. Es wurde versucht sich mit </font><font color='red'>" 
                . $inputUsername . " und dem Password </font><font color='red'>" 
                . $inputPasswd . " einzuloggen.</font>";
        }
    }
    
?>