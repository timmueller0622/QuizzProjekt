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
            if ($r['PLAYERID'] == $id)
                $id++;
        }
	    $sessionkey = null;
	    $sessiontime = null;
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id, $username, $email, $passwd, $sessionkey, $sessiontime]);
            return $id;
        } catch (Exception $e) {
            return "ERROR. USER ALREADY EXISTS OR PARAMETERS INVALID.";
        }
    }
}
?>