<?php

    require 'genrescript.php';
    $questionToEcho = Genre::getRandomQuestionFromGenre(1, 1);
    print_r($questionToEcho);

?>