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

        $betreff = 'Quizzapp Reset Passwd';
        $nachricht = 'Ihr neues Passwort: ' . $newPasswd;
        $header = 'From: Michael.Nettersheim@bib.de' . "\r\n" .
        'Reply-To: Michael.Nettersheim@bib.de' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($emailinput, $betreff, $nachricht, $header);

        $toExecute = $conn -> prepare("UPDATE TABLE PLAYER SET USERPASSWORD =" . $newPasswd . " WHERE EMAIL = " . $emailinput);
        $toExecute->execute();
    }
}



$test ResetUser::sendResetEmail("marc.pape@edu.bib.de");
echo "Mail worked: " . $test;

?>