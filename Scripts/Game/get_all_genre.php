<?php
/*Call this Script for API Request*/
require 'genrescript.php';
$data = Genre::getAllGenres();
print_r($data);
return $data;
?>
