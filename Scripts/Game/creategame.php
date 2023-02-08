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
        $roundcount = 3;
        $gametime = null;
        $stmt = $conn->prepare($sql);
        $stmt->execute([$gameid, $roundcount, $gametime]);
        return array(array('GAMEID'=>$gameid));
    }

    static function createRound($gameid, $difficulty, $genre)
    {
        require '../connectToDatabase.php';
        
        $sql = "INSERT INTO round (roundid, gameid, settingid) VALUES (?, ?, ?)";
        echo "test1<br>";
        $roundid = $conn->query("SELECT count(*) FROM round")->fetchAll()[0][0];
        echo "test2<br>";
        foreach ($conn->query("SELECT * FROM round") as $r) {
            echo "test3<br>";
            if ($r['ROUNDID'] == $roundid)
                $roundid++;
            echo "test4<br>";
            
        }
        echo "test5<br>";
        $sql2 = "SELECT * FROM roundsetting WHERE genre =" . $genre . "AND difficulty =" . $difficulty;
        print_r($conn->query($sql2)->fetchAll()[0][0]);
        $settingid = $conn->query($sql2)->fetchAll()[0][0];
        echo "test6<br>";
        $stmt = $conn->prepare($sql);
        echo "test7<br>";
        try {
            echo "test8<br>";
            $stmt->execute([$roundid, $gameid, $settingid]);
            echo "test9<br>";
        } catch (Exception $e) {
            echo $e;
        }
        return array(array('ROUNDID'=>$roundid));
    }

    static function createQuestions($questionsperround, $roundid){
        require '../connectToDatabase.php';
        $existingQuestionsInRound = $conn->query("SELECT count(*) FROM question WHERE roundid=" . $roundid)->fetchAll()[0][0];
        if ($existingQuestionsInRound >= $questionsperround){
            echo "round filled with questions already";
            $getQuestions = "SELECT questionid FROM question WHERE roundid =" . $roundid;
            $toReturn = $conn->query($getQuestions)->fetchAll();
            return $toReturn;
        }
        $questiondata = QuestionData::getQuestionFromSettings($roundid);
        $sql = "INSERT INTO question (questionid, answeredcorrectly, roundid, QUESTIONDATAID) VALUES (?, ?, ?, ?)";
        for ($i=0; $i < $questionsperround; $i++) {
            $questionid = $conn->query("SELECT count(*) FROM question")->fetchAll()[0][0];
            foreach ($conn->query("SELECT * FROM question") as $r) {
                if ($r['QUESTIONID'] == $questionid)
                    $questionid++;
            }
            $questiondataid = explode(";", $questiondata[$i])[0];
            $stmt = $conn->prepare($sql);
            try{
                $stmt->execute([$questionid, 0, $roundid, $questiondataid]);
            }catch (Exception $e){
                echo $e;
            }
        }

        $getQuestions = "SELECT questionid FROM question WHERE roundid =" . $roundid;
        $toReturn = $conn->query($getQuestions)->fetchAll();
        return $toReturn;
    }
}
