<?php
header("Content-Type: application/json");
require 'checkanswerscript.php';
$output = "Aufruf fehlgeschlagen! Keine Parameter!";
if (isset($_GET['answerid'])) {
    $output = "";
    $output = Answer::check_answer_is_correct($_GET['answerid']);
}
echo json_encode($output);
?>