<?php
class Game
{
    static function createGame()
    {
        require '../connectToDatabase.php';
        $sql = "INSERT INTO game (gameid, roundcount, gametime) VALUES (?, ?, ?)";
        $gameid = $conn->query("SELECT count(*) FROM game")->fetchAll()[0][0];
        foreach ($conn->query("SELECT * FROM game") as $r) {
            if ($r['GAMEID'] == $gameid)
                $gameid++;
        }
        $roundcount = 2;
        $gametime = null;
        $stmt = $conn->prepare($sql);
        $stmt->execute([$gameid, $roundcount, $gametime]);
        return $gameid;
    }

    static function createRound($gameid, $difficulty, $genre)
    {
        require '../connectToDatabase.php';
        $sql = "INSERT INTO round (roundid, gameid, settingid) VALUES (?, ?, ?)";
        $roundid = $conn->query("SELECT count(*) FROM round")->fetchAll()[0];
        foreach ($conn->query("SELECT * FROM round") as $r) {
            if ($r['ROUNDID'] == $roundid)
                $roundid++;
        }
        $sql = "SELECT * FROM roundsetting WHERE genre =" . $genre . "AND difficulty =" . $difficulty;
        $settingid = $conn->query($sql)->fetchAll()[0][0];
        $stmt = $conn->prepare($sql);
        echo "test1";
        try {
            print_r($stmt);
            $stmt->execute([$roundid, $gameid, $settingid]);
        } catch (Exception $e) {
            echo $e;
        }
        return $roundid;
    }
}
