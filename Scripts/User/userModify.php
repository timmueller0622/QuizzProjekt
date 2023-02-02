<?php
/*Klasse, ueber welche auf die verschiedenen Eigenschaften der User-Datensaetze zugegriffen wird.*/
class ModifyUser
{
    public static function modifyUserPasswd($userID, $oldpasswd, $newpasswd): bool
    {
        require '../connectToDatabase.php';
        $sql = 'SELECT * FROM Player WHERE PlayerID = '. $userID;
        $currentUser = $conn->query($sql)->fetchAll()[0];
        if ($currentUser['USERPASSWORD'] == $oldpasswd) {
            $stmt = $conn->prepare('UPDATE player SET userpassword = ? WHERE playerid = ?');
            $stmt->execute([$newpasswd, $userID]);
            return true;
        } else {
            return false;
        }
    }

    public static function modifyUserUsername($userID, $passwd, $newname): bool
    {
        require '../connectToDatabase.php';
        $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID;
        $currentUser = $conn->query($sql)->fetchAll()[0];
        if ($currentUser['USERPASSWORD'] == $passwd) {
            $stmt = $conn->prepare('UPDATE player SET username = ? WHERE playerid = ?');
            $stmt->execute([$newname, $userID]);
            return true;
        } else {
            return false;
        }
    }
    
    public static function modifyUserEmail($userID, $passwd, $newemail): bool
    {
        require '../connectToDatabase.php';
        $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID;
        $currentUser = $conn->query($sql)->fetchAll()[0];
        if ($currentUser['USERPASSWORD'] == $passwd) {
            $stmt = $conn->prepare('UPDATE Player SET Email = ? WHERE PlayerID = ?');
            $stmt->execute([$newemail, $userID]);
            return true;
        } else {
            return false;
        }
    }
}
?>