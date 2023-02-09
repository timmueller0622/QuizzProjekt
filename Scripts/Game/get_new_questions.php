<?php
header("Content-Type: application/json");
require 'creategame.php';
$data = json_encode(Game::createQuestions($_GET['qpr'], $_GET['roundid']));
echo $data;
?>