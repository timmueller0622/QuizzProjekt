<?php

class Statistics{

    static function getMatchHistory($playerid){
        require '../connectToDatabase.php';
        $toReturn = array();
        //get array of all matches saved in matchhistory corresponding to playerid
        $matches = $conn->query("SELECT * FROM matchhistory WHERE playerid = ". $playerid)->fetchAll();
        //iterate over all matches and create and format new entry in returning array for all matches
        for ($i = 0; $i < sizeof($matches); $i++){
            $toReturn['MATCH' . $i] = array('PLAYERID' => $matches[$i]['PLAYERID'], 'WON' => $matches[$i]['WON'], 'LOST' => $matches[$i]['LOST'], 'DRAW' => $matches[$i]['DRAW'],
                'GAME' => Statistics::getGame($matches[$i]['GAMEID']) //get information about game using gameid in match history entry
            );
        }
        return $toReturn;
    }

    static function getGame($gameid){
        require '../connectToDatabase.php';
        //get array containing entry corresponding to corresponding gameid passed in as argument
        $game = $conn->query("SELECT * FROM game WHERE gameid=". $gameid)->fetchAll()[0];
        $toReturn = array();
        //format all variables in array of game entry
        $toReturn['GAMEID'] = $game['GAMEID'];
        $toReturn['ROUNDCOUNT'] = $game['ROUNDCOUNT'];
        $toReturn['GAMETIME'] = $game['GAMETIME'];
        //entry on all information of all rounds played in corresponding game as array
        $toReturn['ROUND'] = Statistics::getRounds($gameid);
        return $toReturn;
    }

    static function getRounds($gameid){
        require '../connectToDatabase.php';
        $toReturn = array();
        //get all rounds corresponding to gameid as array
        $rounds = $conn->query("SELECT * FROM round WHERE gameid=". $gameid)->fetchAll();
        //iterate over all entries
        for($i = 0; $i < sizeof($rounds); $i++){
            //for each entry, get corresponding information on setting entry and question entries
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
        //get array of entry in roundsetting table corresponding to settingid passed in as argument
        $setting = $conn->query("SELECT * FROM roundsetting WHERE settingid=". $settingid)->fetchAll()[0];
        //create genre and diffulty descriptor values as strings using ids in setting array
        $genre = $conn->query("SELECT genredescriptor FROM genre WHERE genreid=". $setting['GENRE'])->fetchAll()[0][0];
        $difficulty = $conn->query("SELECT difficultydescriptor FROM difficulty WHERE difficultyid=". $setting['DIFFICULTY'])->fetchAll()[0][0];
        //format array containing all information of roundsetting to return
        $toReturn = array('SETTINGID' => $setting['SETTINGID'], 'QUESTIONSPERROUND' => $setting['QUESTIONSPERROUND'], 'GENRE' => $genre, 'DIFFICULTY' => $difficulty);
        return $toReturn;
    }

    static function getQuestions($roundid){
        require '../connectToDatabase.php';
        $toReturn = array();
        //get all question entries in question table corresponding to roundid
        $questions = $conn->query("SELECT * FROM question WHERE roundid=". $roundid)->fetchAll();
        //iterate over all entries in questions array
        for($i = 0; $i < sizeof($questions); $i++){
            //format array to return to contain all information found in all question entries
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
        //prepare sql statement to insert entry into match history table
        $sql = "INSERT INTO matchhistory (playerid, gameid, won, lost, draw) VALUES (?, ?, ?, ?, ?)";
        $won = 0;
        $lost = 0;
        $draw = 0;
        //check result string to see which result variable to increment
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
        //prepare sql statement
        $stmt = $conn->prepare($sql);
        try{ //execute statement with prepared variables and variables passed through as argument
            $stmt->execute([$playerid, $gameid, $won, $lost, $draw]);
            //return array containing positive entry result
            return array('ENTRYRESULT' => 'Entry successfully made.');
        } catch (Exception $e){
            //in case of error, return entry result with error string
            return array('ENTRYRESULT' => $e);
        }
    }
}
?>