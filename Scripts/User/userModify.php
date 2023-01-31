<?php 
    /*Klasse, ueber welche auf die verschiedenen Eigenschaften der User-Datensaetze zugegriffen wird.*/
    class ModifyUser{

        public static function modifyUserPasswd($userID, $oldpasswd, $newpasswd) : bool{
            require '../connectToDatabase.php';
            $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID . ';';
            $currentUser = $conn->query($sql);

            if($currentUser['USERPASSWORD'] == $oldpasswd){
                $conn->query('UPDATE TABLE Player SET UserPassword = "' . $newpasswd . '" WHERE PlayerID = '. $userID . ';');
                return true;
            }
            else{
                return false;
            }
        }
        
        public static function modifyUserUsername($userID, $passwd, $newname) : bool{
            require '../connectToDatabase.php';
            $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID . ';';
            $currentUser = $conn->query($sql);

            if($currentUser['USERPASSWORD'] == $passwd){
                $conn->query('UPDATE TABLE Player SET UserName = "' . $newname . '" WHERE PlayerID = '. $userID . ';');
                return true;
            }
            else{
                return false;
            }
        }

        
        public static function modifyUserEmail($userID, $passwd, $newemail) : bool{
            require '../connectToDatabase.php';
            $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID . ';';
            $currentUser = $conn->query($sql);

            if($currentUser['USERPASSWORD'] == $passwd){
                $conn->query('UPDATE TABLE Player SET Email = "' . $newemail . '" WHERE PlayerID = '. $userID . ';');
                return true;
            }
            else{
                return false;
            }
        }



    }


?>