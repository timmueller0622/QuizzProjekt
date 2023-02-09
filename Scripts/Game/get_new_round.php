<?php
//header("Content-Type: application/json");
require 'creategame.php';
$data = Game::createRound($_GET['playerid'], $_GET['gameid'], $_GET['difficulty'], $_GET['genre']);
echo "<br><br><br><br><br><br>" . json_encode($data);
?>