<?php

class Statistics{

    static function getMatchHistory($playerid){
        require '../connectToDatabase.php';
        $toReturn = array();
        $matchH = $conn->query("SELECT * FROM matchhistory WHERE playerid = ". $playerid)->fetchAll();
        for ($i = 0; $i < sizeof($matchH); $i++){
            $toReturn['MATCH' . $i] = array('PLAYERID' => $matchH[$i]['PLAYERID'], 'WON' => $matchH[$i]['WON'], 'LOST' => $matchH[$i]['LOST'], 'DRAW' => $matchH[$i]['DRAW'],
                'GAME' => Statistics::getGame($matchH[$i]['GAMEID'])
            );
        }
        return $toReturn;
    }

    static function getGame($gameid){
        require '../connectToDatabase.php';
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
                'QUESTIONID' => $questions['QUESTIONID'],
                'QUESTIONDATAID' => $questions['QUESTIONDATAID'],
                'ANSWEREDCORRECTLY' => $questions['ANSWEREDCORRECTLY']
            );
        }
        return $toReturn;
    }
}

?>