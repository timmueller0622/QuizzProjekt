<?php
header("Content-Type: application/json");
require 'userLogin.php';
require '../connectToDatabase.php';
$data = json_encode(array('LOGIN' => array('LOGINRESULT' => LoginUser::proofLoginData($_GET['password'], $_GET['username']))));
echo ($data);
?>