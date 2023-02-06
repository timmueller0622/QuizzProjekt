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
        $roundid = $conn->query("SELECT count(*) FROM round")->fetchAll()[0][0];
        foreach ($conn->query("SELECT * FROM round") as $r) {
            if ($r['ROUNDID'] == $roundid)
                $roundid++;
        }
        $sql2 = "SELECT * FROM roundsetting WHERE genre =" . $genre . "AND difficulty =" . $difficulty;
        $settingid = $conn->query($sql2)->fetchAll()[0][0];
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute([$roundid, $gameid, $settingid]);
        } catch (Exception $e) {
            echo $e;
        }
        return $roundid;
    }

    static function createQuestions($questionsperround, $roundid){
        require '../connectToDatabase.php';
        $questiondata = QuestionData::getQuestionFromSettings($roundid);
        $toReturn = array();
        $sql = "INSERT INTO round (questionid, answeredcorrectly, roundid, questiondataid) VALUES (?, ?, ?, ?)";
        for ($i=0; $i < $questionsperround; $i++) {
            
            echo "test<br>";
            $questionid = $conn->query("SELECT count(*) FROM question")->fetchAll()[0][0];
            print_r($questionid);
            foreach ($conn->query("SELECT * FROM question") as $r) {
                if ($r['QUESTIONID'] == $questionid)
                    $questionid++;
            }
            echo "test2<br>";
            $stmt = $conn->prepare($sql);
            
            echo "test3<br>";
            $stmt->execute([$questionid, null, $roundid, $questiondata[$i]]);
            
            echo "test4<br>";
        }
        $getQuestions = "SELECT questionid, questiondescription FROM question 
        JOIN questiondata ON questiondata.questiondataid = question.questiondataid 
        WHERE roundid =" . $roundid;
        $toReturn = $conn->query($getQuestions)->fetchAll();
        return $toReturn;
    }
}
