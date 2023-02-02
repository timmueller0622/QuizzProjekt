<?php

class RegisterUser
{

    public static function createNewUser($username, $passwd, $email)
    {
        echo "test ctd";
        require '../connectToDatabase.php';
        echo "test 1 ";
        $sql = "INSERT INTO player (PLAYERID, USERNAME, EMAIL, USERPASSWORD, SESSIONKEY, SESSIONTIME) VALUES ( ?, ?, ?, ?, ?, ?)";
        if ($username == null || $passwd == null || $email == null) {
            throw new BadMethodCallException("Uebergebene Argumente ungueltig.");
        }
        echo "test 2";
        $id = $conn->query("SELECT count(playerid) FROM player")->fetchAll()[0][0];
        foreach ($conn->query("SELECT * FROM player") as $r){
            while ($r['PLAYERID'] == $id)
                $id++;
        }
        echo "test 3";
	    $sessionkey = null;
	    $sessiontime = null;
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $username, $email, $passwd, $sessionkey, $sessiontime]);
        echo "test 4";
    }
}
?>