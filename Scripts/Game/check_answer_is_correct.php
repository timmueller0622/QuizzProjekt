<?php

/*Call this Script for API Request*/

    require 'checkanswerscript.php';
    $output = "Aufruf fehlgeschlagen! Keine Parameter!";

    if(isset($_GET['answerid']))
    {   
        $output = "";
        $output = Answer::check_answer_is_correct($_GET['answerid']);
    }

    echo $output;

?>