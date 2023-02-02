<?php

require '../../connectToDatabase.php';
require 'choosecategory/categoryscript.php';
$out = getRandomCategory();
echo $out;

?>