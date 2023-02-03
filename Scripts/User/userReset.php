<?php

class ResetUser
{
    static function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, count($alphabet)-1);
            $pass[$i] = $alphabet[$n];
        }
        return $pass;
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