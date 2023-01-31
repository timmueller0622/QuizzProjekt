<?php
    session_start();
    if (!isset($_SESSION["username"]))
        header('Location: loginAPI.php');
	if (isset ($_POST['sub'])){
        require '../connectToDatabase.php';
        $sql = "UPDATE nutzer SET ";
        $count = 0;
        $check = 0;
        foreach($conn->query("SELECT * FROM player WHERE PLAYERID = " . $_GET['id']) as $r){
            for ($j=2; $j < sizeof(array_keys($r)); $j++) { 
                if (is_numeric(array_keys($r)[$j]))
                    continue;
                if (!empty($_POST[array_keys($r)[$j]]))
                    $count++;
            }
        }
        foreach($pdo->query("SELECT * FROM nutzer WHERE ID = " . $_GET['id']) as $r){
            for ($i=2; $i < sizeof(array_keys($r)); $i++) {
                if (is_numeric(array_keys($r)[$i]))
                    continue;
                if (!empty($_POST[array_keys($r)[$i]])){
                    $sql .= array_keys($r)[$i] . " = \"" . $_POST[array_keys($r)[$i]] . "\"";
                    if ($check < $count-1){
                        $sql .= ", ";
                        $check++;
                    }
                }
            }
        }
        $sql .= " WHERE ID = " . $_GET['id'];
        $conn->query($sql);
		header('Location: playerAnzeigen.php');
	} // $_POST['sub']
?>

<!doctype html>
<html>
	<head>
		<title>Player Modifizieren</title>
		<meta charset="utf-8">
		<link href="layout.css" rel="stylesheet">
	</head>
	<body>
		<form method="post">
		<?php
			require 'navi.php';
            require '../connectToDatabase.php';
            if (isset ($_GET['id'])){
                $sql = "SELECT * FROM nutzer WHERE ID = " . $_GET['id'];
                $s = "";
                $s .= "<table align =\"center\" border= \"1\" cellpadding=\"10\" cellspacing=\"0\">";
                $s .= "<thead><tr><th>Data</th><th>Wert</th><th>Modifizierung</th></tr></tr></thead><tbody>";
                foreach($pdo->query($sql) as $r){
                    for ($i=2; $i < sizeof(array_keys($r)); $i++) {
                        if (is_numeric(array_keys($r)[$i]))
                            continue;
                        $s .= "<tr><td>" . array_keys($r)[$i] . "</td>";
                        $s .= "<td>" . array_values($r)[$i] . "</td>";
                        $s .= "<td><input name=\"" . array_keys($r)[$i] . "\"></td></tr>";
                    }
                    $s .= "<td></td><td></td><td><input type=\"submit\" name=\"sub\" value=\"Speichern\"></td>";
                }
                $s .= "</tbody></table>";
                echo $s;
            } // $_POST['sub']
		?>
		</form>
	</body>
</html>