<?php
header("Content-Type: application/json");
require 'settings.php';
$data = Setting::getAllDifficulties();
echo json_encode($data);
?>