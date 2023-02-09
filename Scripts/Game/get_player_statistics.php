<?php
//header("Content-Type: application/json");
require 'statistics.php';
$data = Statistics::getMatchHistory($_GET['playerid']);
echo json_encode($data);
?>