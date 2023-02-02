<?php

    require 'genrescript.php';
    echo "genrescript eingebunden!";
    $questionToEcho = Genre::getRandomQuestionFromGenre(1, 0);
    echo "GenreGetRandomQuestionFromGenre-call succeeded.";
    print_r($questionToEcho);

?>