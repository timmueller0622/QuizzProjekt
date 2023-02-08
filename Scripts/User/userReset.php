<?php

class ResetUser
{
    static function randomPassword() {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); $charsLength = strlen($chars) - 1;
        for ($c = 0; $c < 8; $c++) {
            $x = rand(0, $charsLength);
            $password[] = $chars[$x];
        }
        return implode($password);
    }

    static function sendResetEmail($emailinput)
    {
        $newPasswd = randomPassword();

        require '../connectToDatabase.php'; 
        mail($emailinput, "Quizapp reset Mail", "Your new Password is: " . $newPasswd, "From: QuizzApp Support <Michael.Nettersheim@bib.de>");
        $toExecute = $conn -> prepare("UPDATE TABLE PLAYER SET USERPASSWORD =" . $newPasswd . " WHERE EMAIL = " . $emailinput);
        $toExecute->execute();
    }
}
?>