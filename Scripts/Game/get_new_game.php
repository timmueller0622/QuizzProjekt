<?php
header("Content-Type: application/json");
require 'creategame.php';
$data = Game::createGame();
echo json_encode($data);
?>