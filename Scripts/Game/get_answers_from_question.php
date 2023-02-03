<?php

/*Call this Script for API Request*/

    require 'questionsandanswers.php';
    $output = "Aufruf fehlgeschlagen! Falsche Parameter!";

    if(isset($_GET['questionid']))
    {   
        $answers = QuestionData::getQuestionWithAnswers($_GET['questionid']);
        foreach($genres as $current){
            $output .= $current . "<br>";
        }
    }

    echo $output;

?>