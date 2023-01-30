<?php 
    session_start();
    require '../connectToDatabase.php';
    if (!isset($_SESSION["username"])){
        header('Location: ../Admin/loginAPI.php');
    }

    /*Klasse, ueber welche auf die verschiedenen Eigenschaften der User-Datensaetze zugegriffen wird.*/
    class ModifyUser{

        public static function modifyUserPasswd($userID, $oldpasswd, $newpasswd) : bool{
            $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID . ';';
            $currentUser = $conn->query($sql);

            if($currentUser['UserPassword'] == $oldpasswd){
                $conn->query('UPDATE TABLE Player SET UserPassword = "' . $newpasswd . '" WHERE PlayerID = '. $userID . ';');
                return true;
            }
            else{
                return false;
            }
        }
        
        public static function modifyUserUsername($userID, $passwd, $newname) : bool{
            $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID . ';';
            $currentUser = $conn->query($sql);

            if($currentUser['UserPassword'] == $passwd){
                $conn->query('UPDATE TABLE Player SET UserName = "' . $newname . '" WHERE PlayerID = '. $userID . ';');
                return true;
            }
            else{
                return false;
            }
        }

        
        public static function modifyUserEmail($userID, $passwd, $newemail) : bool{
            $sql = 'SELECT * FROM Player WHERE PlayerID =' . $userID . ';';
            $currentUser = $conn->query($sql);

            if($currentUser['UserPassword'] == $passwd){
                $conn->query('UPDATE TABLE Player SET Email = "' . $newemail . '" WHERE PlayerID = '. $userID . ';');
                return true;
            }
            else{
                return false;
            }
        }



    }


?>