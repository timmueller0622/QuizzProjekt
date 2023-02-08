<?php
require 'userLogin.php';
require '../connectToDatabase.php';
print json_encode(LoginUser::proofLoginData('bib', 'admin'));
?>