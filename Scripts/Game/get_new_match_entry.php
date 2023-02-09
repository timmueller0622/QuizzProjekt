<?php 
header("Content-Type: application/json");
require 'statistics.php';
$data = Statistics::createMatchHistoryEntry($_GET['playerid'], $_GET['gameid'], $_GET['result']);
echo json_encode($data);
?>