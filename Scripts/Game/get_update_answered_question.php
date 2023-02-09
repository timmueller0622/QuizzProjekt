<?php
header("Content-Type: application/json");
require 'questionsandanswers.php';
$data = QuestionData::updateAnsweredQuestion($_GET['questionid']);
echo json_encode($data);
?>