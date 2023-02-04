<?php
    class Game {
        static function createGame() {
            require '../connectToDatabase.php';
            $sql = "INSERT INTO game (gameid, roundcount, gametime) VALUES (?, ?, ?)";
            $gameid = $conn->query("SELECT count(*) FROM game")->fetchAll()[0][0];
            foreach ($conn->query("SELECT * FROM game") as $r){
                if ($r['GAMEID'] == $gameid)
                    $gameid++;
            }
            $roundcount = 5;
            $gametime = null;
            $stmt = $conn->prepare($sql);
        	$stmt->execute([$gameid, $roundcount, $gametime]);
        }
    }
?>