<?php
header("Content-Type: application/json");
require 'creategame.php';
$data = Game::createQuestions($_GET['qpr'], $_GET['roundid']);
echo $data;
?>