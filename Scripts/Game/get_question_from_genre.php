<?php

    require 'genrescript.php';
    $questionToEcho = Genre::getRandomQuestionFromGenre(1, 0);
    print_r($questionToEcho);

?>