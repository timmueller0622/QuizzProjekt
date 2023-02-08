<?php
require 'userLogin.php';
require '../connectToDatabase.php';
$data = json_encode(array(array('LOGINRESULT' => LoginUser::proofLoginData($_GET['password'], $_GET['username']))));
print_r($data);
return $data;
?>