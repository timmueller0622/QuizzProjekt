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
        $toReturn = array('GAME' => array('GAMEID' => $gameid, 'ROUNDCOUNT' => $roundcount, 'GAMETIME' => $gametime));
        return $toReturn;
    }

    static function createRound($gameid, $difficulty, $genre)
    {
        require '../connectToDatabase.php';
        
        $sqlRound = "INSERT INTO round (roundid, gameid, settingid) VALUES (?, ?, ?)";
        $roundid = $conn->query("SELECT count(*) FROM round")->fetchAll()[0][0];
        foreach ($conn->query("SELECT * FROM round") as $r) {
            if ($r['ROUNDID'] == $roundid)
                $roundid++;
        }
        $genreid = $conn->query("SELECT genreid FROM genre WHERE genredescriptor='" . $genre . "'")->fetchAll()[0][0];
        $difficultyid = $conn->query("SELECT difficultyid FROM difficulty WHERE difficultydescriptor='" . $difficulty . "'")->fetchAll()[0][0];
        $sql2 = "SELECT * FROM roundsetting WHERE genre ='" . $genreid . "' AND difficulty ='" . $difficultyid . "'";
        $setting = $conn->query($sql2)->fetchAll()[0];
        $stmt = $conn->prepare($sqlRound);
        try {
            $stmt->execute([$roundid, $gameid, $setting['SETTINGID']]);
        } catch (Exception $e) {
            return array(array('ERROR'=>"Something went wrong."));
        }
        $gameData = $conn->query("SELECT * FROM game WHERE gameid=" . $gameid)->fetchAll()[0];
        $questionData = Game::createQuestions($setting['QUESTIONSPERROUND'], $roundid);
        $toReturn = array(
            'GAME' => array('GAMEID' => $gameid, 'ROUNDCOUNT' => $gameData['ROUNDCOUNT'], 'GAMETIME' => $gameData['GAMETIME']),
            'ROUND' => array('ROUNDID' => $roundid, 'GAMEID' => $gameid, 'SETTINGID' => $setting['SETTINGID']),
            'QUESTIONS' => 'test'
        );
        return $toReturn;
    }

    static function createQuestions($questionsperround, $roundid){
        require '../connectToDatabase.php';
        require 'questionsandanswers.php';
        $existingQuestionsInRound = $conn->query("SELECT count(*) FROM question WHERE roundid=" . $roundid)->fetchAll()[0][0];
        if ($existingQuestionsInRound >= $questionsperround){
            $getQuestions = "SELECT questionid FROM question WHERE roundid =" . $roundid;
            $toReturn = $conn->query($getQuestions)->fetchAll();
            return $toReturn;
        }
        echo 'test1<br>';
        $questiondata = QuestionData::getQuestionFromSettings($roundid);
        echo 'test5<br>';
        print_r($questiondata);
        $sql = "INSERT INTO question (questionid, answeredcorrectly, roundid, questiondataid) VALUES (?, ?, ?, ?)";
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
