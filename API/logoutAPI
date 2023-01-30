<?php
    session_start();
    if (!isset($_SESSION["username"]))
        header('Location: nutzerlogin.php');
    unset($_SESSION["username"]);
    session_destroy();
    header('Location: nutzerlogin.php');
?>