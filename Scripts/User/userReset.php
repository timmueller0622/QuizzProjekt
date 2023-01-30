<?php 
    session_start();
    require '../connectToDatabase.php';
    if (!isset($_SESSION["username"])){
        header('Location: ../Admin/loginAPI.php');
    }

    class ResetUser{

        public static function sendResetEmail($emailinput) : void{
            mail($emailinput, "Quizapp reset Mail test", "ResetTestMail", "From: Michael Nettersheim <Michael.Nettersheim@bib.de>");
        }

    }


    ResetUser::sendResetEmail("marc.pape@edu.bib.de");
?>