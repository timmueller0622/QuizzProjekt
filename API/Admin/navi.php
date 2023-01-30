<?php
    if (!isset($_SESSION["username"]))
        header('Location: loginAPI.php');
    echo '<div align="center">
    <a href="playerAnzeigen.php">Alle Kunden</a> |
    <a href="playerHinzufuegen.php">Neuer Kunde</a> | 
    <a href="playerModifizieren.php">Logout</a>
    </div><hr>';
?>