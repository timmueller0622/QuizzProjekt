<?php
    if (!isset($_SESSION["username"]))
        header('Location: nutzerlogin.php');
    echo '<div align="center">
    <a href="nutzeranzeigen.php">Alle Kunden</a> |
    <a href="nutzerneu.php">Neuer Kunde</a> | 
    <a href="nutzerlogout.php">Logout</a>
    </div><hr>';
?>