<?php
    //connect.php
    echo "\ntestconnectenter<br>";
    try{
            $conn = oci_connect("quizzteam2", "QuizzApp9755", "quizzapp_high");
        echo "\noci connect found<br>";
        if (!$conn){
            echo "\nconnectionfailure<br>";
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        } else {
            echo "<br>SUCCESS: Connected to Oracle!";
        }
    }
    catch (Exception $e){
        echo $e -> getMessage();
    }
    $sql = oci_parse($conn, 'select * from admin.test');
    oci_execute($sql);
    while ($row = oci_fetch_assoc($sql)) {
        echo $row['BEZEICHNUNG'] . "<br>";
    }

    oci_close($conn);
    /*try {
        $pdo = new PDO('oracle:dbname=Team2;host=quizzteam2.jedimasters.net','quizzteam2','QuizzApp9755');
    } catch (Exception $e){
        echo ($e->getMessage());
    }*/
    echo "\ntestconnectreturn<br>";
    
?>