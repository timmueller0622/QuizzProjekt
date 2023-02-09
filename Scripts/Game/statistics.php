<?php

class Statistics{

    static function getMatchHistory($playerid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $matchH = $conn->query("SELECT * FROM matchhistory WHERE playerid = ". $playerId)->fetchAll();
        for ($i = 0; $i < sizeof($matchH); $i++){
            $toReturn['MATCH' . $i] = array('PLAYERID' => $matchH[$i]['PLAYERID'], 'WON' => $matchH[$i]['WON'], 'LOST' => $matchH[$i]['LOST'], 'DRAW' => $matchH[$i]['DRAW'],
                'GAME' => array(Statistics::getGame($matchH[$i]['GAMEID']))
            );
        }
        return $matchH;
    }

    static function getGame($gameid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $game = $conn->query("SELECT * FROM game WHERE gameid = ". $gameid)->fetchAll();
        $toReturn['GAMEID'] = $game['GAMEID'];
        $toReturn['ROUNDCOUNT'] = $game['GAMEID'];
        $toReturn['GAMETIME'] = $game['GAMEID'];
        $toReturn['ROUND'] = Statistics::getRounds($gameid);
        return $toReturn;
    }

    static function getRounds($gameid){
        require '../connectToDatabase.php';
        $toReturn = array();
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
        $setting = $conn->query("SELECT * FROM setting WHERE settingid=". $settingid)->fetchAll()[0];
        $genre = $conn->query("SELECT genredescriptor FROM genre WHERE genreid=". $settingid['GENREID'])->fetchAll()[0][0];
        $difficulty = $conn->query("SELECT difficultydescriptor FROM difficulty WHERE difficultyid=". $settingid['DIFFICULTYID'])->fetchAll()[0][0];
        $toReturn = array('SETTINGID' => $setting['SETTINGID'], 'QUESTIONSPERROUND' => $setting['QUESTIONSPERROUND'], 'GENRE' => $genre, 'DIFFICULTY' => $difficulty);
        return $toReturn;
    }

    static function getQuestions($roundid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $questions = $conn->query("SELECT * FROM questions WHERE roundid=". $gameid)->fetchAll();
        foreach($questions as $question){
            $toReturn['QUESTIONID'] = $question['QUESTIONID'];
            $toReturn['QUESTIONDATAID'] = $question['QUESTIONDATAID'];
            $toReturn['ANSWEREDCORRECTLY'] = $question['ANSWEREDCORRECTLY'];
        }
        return $toReturn;
    }
}

?>