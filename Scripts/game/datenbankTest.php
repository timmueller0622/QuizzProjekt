<?php

require '../../connectToDatabase.php';
require 'choosecategory/categoryscript.php';
$out = getRandomCategory();
print_r($out);

?>