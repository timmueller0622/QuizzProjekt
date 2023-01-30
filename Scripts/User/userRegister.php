<?php 
    session_start();
    require '../connectToDatabase.php';
    if (!isset($_SESSION["username"])){
        header('Location: ../Admin/loginAPI.php');
    }

    class RegisterUser{

        public static function createNewUser($username,$passwd,$email){
            require '../connectToDatabase.php';
            if($username == null || $passwd == null || $email == null){
                throw new BadMethodCallException("Uebergebene Argumente ungueltig.");
            }
            $IDForInsert = $conn->query("SELECT Count(PLAYERID) FROM PLAYER;");
            $conn -> query("INSERT INTO PLAYER (ID, USERNAME, USERPASSWORD, EMAIL) values (" . $IDForInsert . ";" 
            . $username . ";" . $passwd . ";" . $email . ";" . ");");
        }



    }
?>