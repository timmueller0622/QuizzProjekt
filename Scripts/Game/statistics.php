<?php

class Statistics{

    static function getMatchHistory($playerid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $matches = $conn->query("SELECT * FROM matchhistory WHERE playerid = ". $playerid)->fetchAll();
        for ($i = 0; $i < sizeof($matches); $i++){
            echo 'test1<br>';
            $toReturn['MATCH' . $i] = array('PLAYERID' => $matches[$i]['PLAYERID'], 'WON' => $matches[$i]['WON'], 'LOST' => $matches[$i]['LOST'], 'DRAW' => $matches[$i]['DRAW'],
                'GAME' => Statistics::getGame($matchH[$i]['GAMEID'])
            );
        }
        return $toReturn;
    }

    static function getGame($gameid){
        require '../connectToDatabase.php';
        echo 'test2<br>';
        $game = $conn->query("SELECT * FROM game WHERE gameid=". $gameid)->fetchAll()[0];
        $toReturn = array();
        $toReturn['GAMEID'] = $game['GAMEID'];
        $toReturn['ROUNDCOUNT'] = $game['ROUNDCOUNT'];
        $toReturn['GAMETIME'] = $game['GAMETIME'];
        $toReturn['ROUND'] = Statistics::getRounds($gameid);
        return $toReturn;
    }

    static function getRounds($gameid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $rounds = $conn->query("SELECT * FROM round WHERE gameid=". $gameid)->fetchAll();
        for($i = 0; $i < sizeof($rounds); $i++){
            $toReturn['ROUND' . $i] = array(
                'ROUNDID' => $rounds[$i]['ROUNDID'],
                'SETTING' => Statistics::getSettings($rounds[$i]['SETTINGID']),
                'QUESTIONS' => Statistics::getQuestions($rounds[$i]['ROUNDID'])
            );
        }
        return $toReturn;
    }

    static function getSettings($settingid){
        require '../connectToDatabase.php';
        $setting = $conn->query("SELECT * FROM roundsetting WHERE settingid=". $settingid)->fetchAll()[0];
        $genre = $conn->query("SELECT genredescriptor FROM genre WHERE genreid=". $setting['GENRE'])->fetchAll()[0][0];
        $difficulty = $conn->query("SELECT difficultydescriptor FROM difficulty WHERE difficultyid=". $setting['DIFFICULTY'])->fetchAll()[0][0];
        $toReturn = array('SETTINGID' => $setting['SETTINGID'], 'QUESTIONSPERROUND' => $setting['QUESTIONSPERROUND'], 'GENRE' => $genre, 'DIFFICULTY' => $difficulty);
        return $toReturn;
    }

    static function getQuestions($roundid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $questions = $conn->query("SELECT * FROM question WHERE roundid=". $roundid)->fetchAll();
        for($i = 0; $i < sizeof($questions); $i++){
            $toReturn['QUESTION' . $i] = array(
                'QUESTIONID' => $questions[$i]['QUESTIONID'],
                'QUESTIONDATAID' => $questions[$i]['QUESTIONDATAID'],
                'ANSWEREDCORRECTLY' => $questions[$i]['ANSWEREDCORRECTLY']
            );
        }
        return $toReturn;
    }

    static function createMatchHistoryEntry($playerid, $gameid, $result){
        require '../connectToDatabase.php';
        $sql = "INSERT INTO matchhistory (playerid, gameid, won, lost, draw) VALUES (?, ?, ?, ?, ?)";
        $won = 0;
        $lost = 0;
        $draw = 0;
        switch ($result){
            case 'win':
                $won = 1;
                break;
            case 'loss':
                $lost = 1;
                break;
            case 'draw':
                $draw = 1;
                break;
        }
        $stmt = $conn->prepare($sql);
        try{
            $stmt->execute([$playerid, $gameid, $won, $lost, $draw]);
            return array('ENTRYRESULT' => 'Entry successfully made.');
        } catch (Exception $e){
            return array('ENTRYRESULT' => $e);
        }
    }
}

?>