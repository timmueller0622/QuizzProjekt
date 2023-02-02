<?php
if (!isset($_SESSION["username"]))
    header('Location: loginAPI.php');
echo '<div align="center">
<a href="playerAnzeigen.php">Alle Player</a> |
<a href="playerHinzufuegen.php">Neuer Player</a> | 
<a href="logoutAPI.php">Logout</a>
</div><hr>
<div align="center">
<a href="startGame.php">Spiel beginnen</a>
</div><hr>';
?>
