<?php

use function PHPSTORM_META\type;

	session_start();
	if (!isset($_SESSION["username"]))
		header('Location: loginAPI.php');
	if (isset ($_POST['sub'])){
		require '../connectToDatabase.php';
		$sql = "INSERT ALL INTO player (";
        foreach($conn->query("SELECT * FROM player") as $r){
            for ($i=0; $i < sizeof(array_keys($r)); $i++) {
                if (is_numeric(array_keys($r)[$i]))
                    continue;
                $sql .= array_keys($r)[$i];
				if ($i < sizeof(array_keys($r))-2)
					$sql .= ", ";
            }
			$sql .= ") VALUES (";
			for ($i=0; $i < sizeof(array_keys($r)); $i++) {
                if (is_numeric(array_keys($r)[$i]))
                    continue;
				if ($i == 0){
					$pcount = $conn->query("SELECT count(playerid) FROM player")->fetchAll();
					$sql .= $pcount[0][0] . ", ";
				}
				else{
					if (isset($_POST[array_keys($r)[$i]]))
						$sql .= "'" . $_POST[array_keys($r)[$i]] . "'";
					else
						$sql .= "NULL";
					if ($i < sizeof(array_keys($r))-2)
							$sql .= ", ";
                	
				}
            }
			$sql .= ") SELECT * FROM DUAL;";
			break;
        }
		echo $sql;
		try {
			$conn->query($sql);
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