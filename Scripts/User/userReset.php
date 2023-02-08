<?php

class ResetUser
{
    /*static function randomPassword() {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); $charsLength = strlen($chars) - 1;
        for ($c = 0; $c < 8; $c++) {
            $x = rand(0, $charsLength);
            $password[] = $chars[$x];
        }
        return implode($password);
    }*/

    static function sendResetEmail($emailinput)
    {
        $newPasswd = "HierStehtDasNeuePasswort"; //randomPassword();
        //require '../connectToDatabase.php'; 

        $betreff = 'Quizzapp Reset Passwd';
        $nachricht = 'Ihr neues Passwort: ' . $newPasswd;
        $header = 'From: michael.nettersheim@bib.de' . "\r\n" . 'Reply-To: michael.nettersheim@bib.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

        $worked=mail($emailinput, $betreff, $nachricht, $header);
        return $worked;
        //$toExecute = $conn -> prepare("UPDATE TABLE PLAYER SET USERPASSWORD =" . $newPasswd . " WHERE EMAIL = " . $emailinput);
        //$toExecute->execute();
    }
}


echo "bound worked.";
$test = " -> ";
$test .= ResetUser::sendResetEmail("marc.pape@edu.bib.de");
echo "Mail worked: " . $test;

?>