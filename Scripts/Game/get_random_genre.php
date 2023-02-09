<?php
header("Content-Type: application/json");
require 'genrescript.php';
$data = Genre::getRandomGenre();
echo json_encode($data);
?>