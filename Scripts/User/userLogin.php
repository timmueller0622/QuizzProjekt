<?php

class LoginUser
{
    public static function proofLoginData($passwd, $username)
    {
        try {
            require '../connectToDatabase.php';
            //sucht nach Einträgen in der player tabelle
            $dataToProof = $conn->query("SELECT * FROM player WHERE username = '" . $username . "'")->fetchAll()[0];
            //überprüft ob das passwort übereinstimmt
            if ($dataToProof['USERPASSWORD'] == $passwd) {
                //gibt eine playerid zurück falls es einen eintrag gibt
                return $dataToProof['PLAYERID'];
            } else {
                //gibt false zurück falls es keinen gibt
                return "test";
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
