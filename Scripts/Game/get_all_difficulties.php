<?php

/*Call this Script for API Request*/

require 'difficultyscript.php';
$data = Difficulty::getAllDifficulties();
print_r($data);
return $data;

?>