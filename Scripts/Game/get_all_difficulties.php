<?php
header("Content-Type: application/json");
require 'difficultyscript.php';
$data = Difficulty::getAllDifficulties();
echo json_encode($data);
?>