<?php

    require 'genrescript.php';
    echo "genrescript eingebunden!";
    $questionToEcho = Genre::getRandomQuestionFromGenre(1, 1);
    echo "GenreGetRandomQuestionFromGenre-call succeeded.";
    print_r($questionToEcho);

?>