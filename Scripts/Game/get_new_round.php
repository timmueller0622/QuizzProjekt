<?php
header("Content-Type: application/json");
require 'creategame.php';
$data = Game::createRound($_GET['gameid'], $_GET['difficulty'], $_GET['genre']);
echo json_encode($data);
?>