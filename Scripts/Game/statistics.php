<?php

class Statistics{

    static function getMatchHistory($playerid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $matchH = $conn->query("SELECT * FROM matchhistory WHERE playerid = ". $playerid)->fetchAll();
        for ($i = 0; $i < sizeof($matchH); $i++){
            $toReturn['MATCH' . $i] = array('PLAYERID' => $matchH[$i]['PLAYERID'], 'WON' => $matchH[$i]['WON'], 'LOST' => $matchH[$i]['LOST'], 'DRAW' => $matchH[$i]['DRAW'],
                'GAME' => array(Statistics::getGame($matchH[$i]['GAMEID']))
            );
        }
        return $matchH;
    }

    static function getGame($gameid){
        require '../connectToDatabase.php';
        $game = $conn->query("SELECT * FROM game WHERE gameid = ". $gameid)->fetchAll();
        $toReturn = array(
            'GAMEID' => $game['GAMEID'],
            'ROUNDCOUNT' => $game['ROUNDCOUNT'],
            'GAMETIME' => $game['GAMETIME'],
            'ROUND' => 'test'//Statistics::getRounds($gameid)
        );
        return $toReturn;
    }

    static function getRounds($gameid){
        require '../connectToDatabase.php';
        $toReturn = array();
        echo 'testround<br>';
        $rounds = $conn->query("SELECT * FROM round WHERE gameid=". $gameid)->fetchAll();
        foreach($rounds as $round){
            $toReturn['ROUNDID'] = $round['ROUNDID'];
            $toReturn['SETTING'] = Statistics::getSettings($round['SETTINGID']);
            $toReturn['QUESTIONS'] = Statistics::getQuestions($round['ROUNDID']);
        }
        return $toReturn;
    }

    static function getSettings($settingid){
        require '../connectToDatabase.php';
        echo 'settingid: ' . $settingid;
        $setting = $conn->query("SELECT * FROM roundsetting WHERE settingid=". $settingid)->fetchAll()[0];
        print_r($setting);
        $genre = $conn->query("SELECT genredescriptor FROM genre WHERE genreid=". $setting['GENRE'])->fetchAll()[0][0];
        echo 'test2<br>';
        $difficulty = $conn->query("SELECT difficultydescriptor FROM difficulty WHERE difficultyid=". $setting['DIFFICULTY'])->fetchAll()[0][0];
        echo 'test3<br>';
        $toReturn = array('SETTINGID' => $setting['SETTINGID'], 'QUESTIONSPERROUND' => $setting['QUESTIONSPERROUND'], 'GENRE' => $genre, 'DIFFICULTY' => $difficulty);
        return $toReturn;
    }

    static function getQuestions($roundid){
        require '../connectToDatabase.php';
        $toReturn = array();
        echo 'test1<br>';
        $questions = $conn->query("SELECT * FROM question WHERE roundid=". $roundid)->fetchAll();
        echo 'test2<br>';
        foreach($questions as $question){
            $toReturn['QUESTIONID'] = $question['QUESTIONID'];
            $toReturn['QUESTIONDATAID'] = $question['QUESTIONDATAID'];
            $toReturn['ANSWEREDCORRECTLY'] = $question['ANSWEREDCORRECTLY'];
        }
        return $toReturn;
    }
}

?>