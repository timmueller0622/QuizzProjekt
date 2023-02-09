<?php
header("Content-Type: application/json");
require 'userRegister.php';
$data = json_encode(array('REGISTER' => array('REGISTERRESULT' => RegisterUser::createNewUser($_GET['username'], $_GET['password'], $_GET['email']))));
echo $data;
?>