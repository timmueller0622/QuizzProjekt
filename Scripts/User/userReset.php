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
        $worked = mail('Tim.Mueller@edu.bib.de', 'Quizzapp Password Reset', 'Neues Passwort: ' . $newPasswd, '','');
        return $worked;
        //$toExecute = $conn -> prepare("UPDATE TABLE PLAYER SET USERPASSWORD =" . $newPasswd . " WHERE EMAIL = " . $emailinput);
        //$toExecute->execute();
    }
}
$test = "Aufruf der methode fehlgeschlagen.";
$test = " -> " . ResetUser::sendResetEmail('marc.pape-info@web.de')? 'true' : 'false';
echo "Mail worked: " . $test;
?>