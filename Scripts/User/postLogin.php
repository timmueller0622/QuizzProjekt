<?php
header("Content-Type: application/json");
require 'userLogin.php';
$data = json_encode(array('LOGIN' => array('LOGINRESULT' => LoginUser::proofLoginData($_GET['password'], $_GET['username']))));
echo getenv('REQUEST_METHOD');
echo $data;
?>