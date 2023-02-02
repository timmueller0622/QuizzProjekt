<?php 

    class ResetUser{

        public static function sendResetEmail($emailinput){
            mail($emailinput, "Quizapp reset Mail test", "ResetTestMail", "From: Tim Mueller <Tim.Mueller@edu.bib.de>");
        }
    }
?>