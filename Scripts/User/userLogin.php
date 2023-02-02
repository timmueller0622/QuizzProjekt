<?php

class LoginUser
{
    public static function proofLoginData($passwd, $username)
    {
        try {
            echo "test1" . $username;
            require '../connectToDatabase.php';
            echo "test2" . $passwd;
            $dataToProof = $conn->query("SELECT * FROM player WHERE username = '" . $username . "'")->fetchAll()[0];
            echo "test3" . $dataToProof['USERPASSWORD'];
            if ($dataToProof['USERPASSWORD'] == $passwd) {
                echo "test4" . $dataToProof['PLAYERID'];
                return $dataToProof['PLAYERID'];
            } else {
                echo "test5";
                return false;
            }
        } catch (Exception $e) {
            print_r($e);
        }
    }
    public static function echoWrongLoginData($inputPasswd, $inputUsername): void
    {
        echo "<font color='red'> Logindaten ungültig. Es wurde versucht sich mit </font><font color='red'>"
            . $inputUsername . " und dem Password </font><font color='red'>"
            . $inputPasswd . " einzuloggen.</font>";
    }
}
