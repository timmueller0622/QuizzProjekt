<?php

    require 'genrescript.php';
    $output = "Aufruf fehlgeschlagen! Falsche Parameter!";
    if(isset($_GET['genreid']) && isset($_GET['difficultyid']))
    {   
        $genreID = $_GET['genreid'];
        $$difficultyID = $_GET['difficultyid'];
        $output = Genre::getRandomQuestionFromGenre($genreID, $$difficultyID);
    }

    echo $output;

?>