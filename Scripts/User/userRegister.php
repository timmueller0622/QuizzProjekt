<?php

class RegisterUser
{

    public static function createNewUser($username, $passwd, $email)
    {
        require '../connectToDatabase.php';
        $sql = "INSERT INTO player (PLAYERID, USERNAME, EMAIL, USERPASSWORD, SESSIONKEY, SESSIONTIME) VALUES ( ?, ?, ?, ?, ?, ?)";
        if ($username == null || $passwd == null || $email == null) {
            throw new BadMethodCallException("Uebergebene Argumente ungueltig.");
        }
        $id = $conn->query("SELECT count(playerid) FROM player")->fetchAll()[0][0];
        foreach ($conn->query("SELECT * FROM player") as $r){
            while ($r['PLAYERID'] == $id)
                $id++;
        }
	    $sessionkey = null;
	    $sessiontime = null;
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id, $username, $email, $passwd, $sessionkey, $sessiontime]);
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>