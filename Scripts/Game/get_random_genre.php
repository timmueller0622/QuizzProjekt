<?php
header("Content-Type: application/json");
require 'settings.php';
$data = Setting::getRandomGenre();
echo json_encode($data);
?>