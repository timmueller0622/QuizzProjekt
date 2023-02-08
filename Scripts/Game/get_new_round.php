<?php

/*Call this Script for API Request*/

require 'creategame.php';
JSON.string(json_encode(Game::createRound($_GET['gameid'], $_GET['difficulty'], $_GET['genre'])));

?>