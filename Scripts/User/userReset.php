<?php 
    session_start();
    require '../connectToDatabase.php';
    if (!isset($_SESSION["username"])){
        header('Location: ../Admin/loginAPI.php');
    }

    class ResetUser{

        public static function sendResetEmail($emailinput) : void{
            mail($emailinput, "Quizapp reset Mail", "ResetTestMail", "From: QuizzappDevelopment <Marc.Pape@edu.bib.de>");
        }

    }


    ResetUser::sendResetEmail("marc.pape-info@web.de");
?>