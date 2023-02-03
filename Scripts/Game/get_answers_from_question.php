<?php

/*Call this Script for API Request*/

    require 'questionsandanswers.php';
    $output = "Aufruf fehlgeschlagen! Keine Parameter!";

    if(isset($_GET['questionid']))
    {   
        $answers = QuestionData::getQuestionWithAnswers($_GET['questionid']);
        foreach($answers as $current){
            $output .= $current . "<br>";
        }
    }

    echo $output;

?>