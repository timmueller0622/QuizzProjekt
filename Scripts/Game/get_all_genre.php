<?php
header("Content-Type: application/json");
require 'settings.php';
$data = Setting::getAllGenres();
echo json_encode($data);
?>
