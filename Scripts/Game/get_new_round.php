<?php

/*Call this Script for API Request*/

require 'creategame.php';
print_r(json_encode(Game::createRound($_GET['gameid'], $_GET['genre'], $_GET['difficulty'])));

?>