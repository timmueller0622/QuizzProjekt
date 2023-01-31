<?php

use function PHPSTORM_META\type;

	session_start();
	if (!isset($_SESSION["username"]))
		header('Location: loginAPI.php');
	if (isset ($_POST['sub'])){
		require '../connectToDatabase.php';
		$sql = "INSERT INTO player (PLAYERID, USERNAME, EMAIL, USERPASSWORD, SESSIONKEY, SESSIONTIME) VALUES ( ?, ?, ?, ?, ?, ?)";
		$id = $conn->query("SELECT count(playerid) FROM player")->fetchAll()[0][0];
		$username = $_POST['USERNAME'];
		$email = $_POST['EMAIL'];
		$userpassword = $_POST['USERPASSWORD'];
		$sessionkey = null;
		$sessiontime = null;
		$data = array();
		echo $sql;
		try {
			$smst = $conn->prepare($sql);
			$smst->execute([$id, $username, $email, $userpassword, $sessionkey, $sessiontime]);
		} catch(Exception $e) {
			echo $e;
		}
		//header('Location: playerAnzeigen.php');
	}
?>

<!doctype html>
<html>
	<head>
		<title>Player hinzufügen</title>
		<meta charset="utf-8">
		<link href="layout.css" rel="stylesheet">
	</head>
	<body>
		<form method="post">
		<?php
			require 'navi.php';
			require '../connectToDatabase.php';
            $s = "";
            $s .= "<table align =\"center\" border= \"1\" cellpadding=\"10\" cellspacing=\"0\">";
            $s .= "<thead><tr><th>Data</th><th>Wert</th></tr></tr></thead><tbody>";
            foreach($conn->query("SELECT * FROM player") as $r){
                for ($i=2; $i < sizeof(array_keys($r))-4; $i++) {
                    if (is_numeric(array_keys($r)[$i]))
                        continue;
                    $s .= "<tr><td>" . array_keys($r)[$i] . "</td>";
                    $s .= "<td><input name=\"" . array_keys($r)[$i] . "\"></td></tr>";
                }
                $s .= "<td></td><td><input type=\"submit\" name=\"sub\" value=\"Speichern\"></td>";
				break;
            }
            $s .= "</tbody></table>";
            echo $s;
		?>
		</form>
	</body>
</html>