<?php
class Game
{
    static function createGame()
    {
        require '../connectToDatabase.php';
        //prepare sql statement as string
        $sql = "INSERT INTO game (gameid, roundcount, gametime) VALUES (?, ?, ?)";
        //get preliminary gameid from the amount of current entries in game table
        $gameid = $conn->query("SELECT count(*) FROM game")->fetchAll()[0][0];
        //iterate over game table to see if gameid already exists
        foreach ($conn->query("SELECT * FROM game") as $r) {
            if ($r['GAMEID'] == $gameid) //if gameid exists, increment gameid by one
                $gameid++;
        }
        $roundcount = 3; //roundcount set at 3, but can be adjusted by passing through variable at a later time
        $gametime = null; //gametime is nullable and is recorded on clientside to be updated later
        $stmt = $conn->prepare($sql); //prepare sql statement
        //execute statement to create entry in game table
        $stmt->execute([$gameid, $roundcount, $gametime]);
        //create array with parameters
        $toReturn = array('GAME' => array('GAMEID' => $gameid, 'ROUNDCOUNT' => $roundcount, 'GAMETIME' => $gametime));
        //pass it back to be encoded in script
        return $toReturn;
    }

    static function createRound($playerid, $gameid, $difficulty, $genre)
    {
        require '../connectToDatabase.php';

        //check if game still allows for rounds to be created
        $existingRoundsInGame = $conn->query("SELECT count(*) FROM round WHERE gameid=" . $gameid)->fetchAll()[0][0];
        $roundcount = $conn->query("SELECT roundcount FROM game WHERE gameid=" . $gameid)->fetchAll()[0][0];
        if ($existingRoundsInGame >= $roundcount){
            $toReturn = array('ERROR' => 'Game already over. No more rounds to be played.');
            return $toReturn;
        }

        //prepare sql statemtent to insert entry into round table
        $sqlRound = "INSERT INTO round (roundid, gameid, settingid) VALUES (?, ?, ?)";
        //get preliminary gameid from the amount of current entries in round table
        $roundid = $conn->query("SELECT count(*) FROM round")->fetchAll()[0][0];
        //iterate over round table to see if roundid already exists
        foreach ($conn->query("SELECT * FROM round") as $r) {
            if ($r['ROUNDID'] == $roundid) //if roundid exists, increment gameid by one
                $roundid++;
        }
        //get genreid as string from query using passed in genreid argument
        $genreid = $conn->query("SELECT genreid FROM genre WHERE genredescriptor='" . $genre . "'")->fetchAll()[0][0];
        //get difficultyid as string from query using passed in difficultyid argument
        $difficultyid = $conn->query("SELECT difficultyid FROM difficulty WHERE difficultydescriptor='" . $difficulty . "'")->fetchAll()[0][0];
        //prepare sql statement as string to make query from setting table
        $sqlSetting = "SELECT * FROM roundsetting WHERE genre ='" . $genreid . "' AND difficulty ='" . $difficultyid . "'";
        $setting = $conn->query($sqlSetting)->fetchAll()[0];
        //prepare sql statement to insert round
        $stmt = $conn->prepare($sqlRound);
        try { //execute statement with passed in arguments and prepared variables
            $stmt->execute([$roundid, $gameid, $setting['SETTINGID']]);
        } catch (Exception $e) { //return array with error message if something goes wrong
            return array('ERROR'=>"Something went wrong.");
        }
        //fetch entry in game table correlating to created entry in round table
        $gameData = $conn->query("SELECT * FROM game WHERE gameid=" . $gameid)->fetchAll()[0];
        //create entries in question table and save as array
        $questionData = Game::createQuestions($setting['QUESTIONSPERROUND'], $roundid, $playerid);
        //create and format array to return with formatted entry in game table, round table and entries in question table
        $toReturn = array(
            'GAME' => array('GAMEID' => $gameid, 'ROUNDCOUNT' => $gameData['ROUNDCOUNT'], 'GAMETIME' => $gameData['GAMETIME']),
            'ROUND' => array('ROUNDID' => $roundid, 'GAMEID' => $gameid, 'SETTINGID' => $setting['SETTINGID']),
            'QUESTIONS' => $questionData
        );
        return $toReturn;
    }

    static function createQuestions($questionsperround, $roundid, $playerid){
        require '../connectToDatabase.php';
        require 'questionsandanswers.php';

        //first check if round already has questions created for it
        $existingQuestionsInRound = $conn->query("SELECT count(*) FROM question WHERE roundid=" . $roundid)->fetchAll()[0][0];
        if ($existingQuestionsInRound >= $questionsperround){
            $getQuestions = "SELECT questionid FROM question WHERE roundid =" . $roundid;
            $toReturn = $conn->query($getQuestions)->fetchAll();
            return $toReturn;
        }

        //get all questions relating to settings in array
        $questiondata = QuestionData::getQuestionsFromSettings($roundid);
        $toReturn = array();
        //prepare sql statement as string to insert questions
        $sql = "INSERT INTO question (questionid, answeredcorrectly, roundid, questiondataid) VALUES (?, ?, ?, ?)";
        //iterate over number of allowed questions in this round
        //use counter to keep track of questions that were already answered correctly
        //use counter to iterate over questiondata array
        //use counter to add unique keys to returning array
        $sameQuestionCounter = 0;
        $qCounter = 0;
        $i = 0;
        while (sizeof($toReturn) < $questionsperround){
            //get preliminary questionid by counting all entries in question table
            $questionid = $conn->query("SELECT count(*) FROM question")->fetchAll()[0][0];
            //iterate over question table and check if questionid already exists
            foreach ($conn->query("SELECT * FROM question") as $r) {
                if ($r['QUESTIONID'] == $questionid) //if yes, increment questionid
                    $questionid++;
            }
            //create variable that holds questiondataid
            $questiondataid = $questiondata[$qCounter++]['QUESTIONDATAID'];
            if ($qCounter >= sizeof($questiondata)) //if questioncounter should go out of bounds reset to 0
                $qCounter = 0;
            if (Game::getQuestionAlreadyAnswered($playerid, $questiondataid) == true && $sameQuestionCounter <= $questionsperround){
                //if the question was already answered correctly and the number of questions already answered is smaller than
                //the number of questions needed for this round, increment answered question counter by 1
                //and skip insert statement and growing and formatting of returning array
                $sameQuestionCounter++;
                continue;
            }
            //prepare sql statement
            $stmt = $conn->prepare($sql);
            //execute statement using created variables
            $stmt->execute([$questionid, 0, $roundid, $questiondataid]);
            //get question from questionid as array and save it in returning array
            $toReturn['QUESTION' . $i++] = QuestionData::getQuestion($questionid);
        }
        return $toReturn;
    }

    static function getQuestionAlreadyAnswered($playerid, $questiondataid){
        require '../connectToDatabase.php';
        //prepare sql statement as string to check if player has already answered the question correctly once before
        $sql = "SELECT answeredcorrectly FROM matchhistory
            JOIN game ON game.gameid = matchhistory.gameid
            JOIN round ON round.gameid = game.gameid
            JOIN question ON question.roundid = round.roundid
            JOIN questiondata ON questiondata.questiondataid = question.questiondataid
            WHERE matchhistory.playerid =" . $playerid . " AND questiondata.questiondataid=" . $questiondataid;
        $toReturn = $conn->query($sql)->fetchAll()[0][0];
        if ($toReturn == 1) //if answered correctly then return true
            return true;
        else //else return false
            return false;
    }
}
