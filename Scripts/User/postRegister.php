<?php
header("Content-Type: application/json");
require 'userLogin.php';
$data = json_encode(array('LOGIN' => array('LOGINRESULT' => RegisterUser::createNewUser($_GET['username'], $_GET['password'], $_GET['email']))));
echo $data;
?>