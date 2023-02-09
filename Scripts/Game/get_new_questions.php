<?php
//header("Content-Type: application/json");
require 'questionsandanswers.php';
$data = json_encode(QuestionData::getQuestion($_GET['qpr']));
echo $data;
?>