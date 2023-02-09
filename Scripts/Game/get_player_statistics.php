<?php
//header("Content-Type: application/json");
require 'statistics.php';
$data = Statistics::getMatchHistory($_GET['playerid']);
print_r($data);
?>