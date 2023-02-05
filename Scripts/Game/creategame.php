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
            $roundcount = 2;
            $gametime = null;
            $stmt = $conn->prepare($sql);
        	$stmt->execute([$gameid, $roundcount, $gametime]);
            return $gameid;
        }

        static function createRound($gameid, $difficulty, $genre) {
            require '../connectToDatabase.php';
            $sql = "INSERT INTO round (roundid, gameid, settingid) VALUES (?, ?, ?)";
            $roundid = $conn->query("SELECT count(*) FROM round")->fetchAll()[0][0];
            foreach ($conn->query("SELECT * FROM round") as $r){
                if ($r['ROUNDID'] == $roundid)
                    $roundid++;
            }
            $sql = "SELECT settingid FROM roundsetting
                WHERE difficulty =" . $difficulty .
                "AND WHERE genre = " . $genre;
            $setting = $conn->query($sql)->fetchAll();
            print_r($setting);
            //$stmt = $conn->prepare($sql);
        	//$stmt->execute([$roundid, $gameid, $setting]);
            //return $roundid;
        }
    }
?>