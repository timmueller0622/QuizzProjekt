<?php
require 'userLogin.php';
require '../connectToDatabase.php';
print json_encode(array(array('LOGINRESULT' => LoginUser::proofLoginData($_POST['PASSWORD'], $POST_['USERNAME']))));
?>