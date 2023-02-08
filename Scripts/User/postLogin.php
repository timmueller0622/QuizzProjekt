<?php
require 'userLogin.php';
require '../connectToDatabase.php';
print json_encode(array(array('LOGINRESULT' => LoginUser::proofLoginData('bib', 'admin'))));
?>