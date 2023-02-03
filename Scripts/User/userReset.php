<?php

class ResetUser
{

    public static function sendResetEmail($emailinput)
    {
        $newPasswd = "testNewPasswd";

        require '../connectToDatabase.php'; 
        mail($emailinput, "Quizapp reset Mail", "Your new Password is: " . $newPasswd, "From: QuizzApp Support <Michael.Nettersheim@bib.de>");
        $toExecute = $conn -> prepare("UPDATE TABLE PLAYER SET USERPASSWORD =" . $newPasswd . " WHERE EMAIL = " . $emailinput);
        $toExecute->execute();
    }
}
?>