<?php
session_start();
if (!isset($_SESSION["username"]))
    header('Location: loginAPI.php');
unset($_SESSION["username"]);
session_destroy();
header('Location: loginAPI.php');
?>