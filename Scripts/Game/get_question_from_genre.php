<?php

    require 'genrescript.php';
    $questionToEcho = Genre::getRandomQuestionFromGenre(2, 0);
    echo $questionToEcho;

?>