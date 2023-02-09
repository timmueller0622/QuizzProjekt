<?php
header("Content-Type: application/json");
require 'genrescript.php';
$data = Genre::getAllGenres();
echo json_encode($data);
?>
