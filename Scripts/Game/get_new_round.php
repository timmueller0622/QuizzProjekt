<?php

/*Call this Script for API Request*/

require 'creategame.php';
echo $_GET['gameid'];
echo $_GET['genre'];
echo $_GET['difficulty'];
print_r(json_encode(Game::createRound($_GET['gameid'], $_GET['genre'], $_GET['difficulty'])));

?>