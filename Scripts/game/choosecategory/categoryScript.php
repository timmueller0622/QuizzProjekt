<?php

$out2 = "categoryscript : test";
/*TestÄnderung*/
//class Category{
    public static function getRandomCategory() : string{
        //require '../../connectToDatabase.php';
        //echo "succsess connectToDatabase";
        
        /*$GenreArray = array();
        $pos = 0;

        foreach($conn->query("SELECT * FROM Genre") as $row){
            
            $GenreArray[$pos] += $row;
            $pos++;

        }

        $categoryToReturn = $GenreArray[rand(0, sizeof($GenreArray))]['GenreDescriptor'];*/

        return /*$categoryToReturn*/ "test";
    }

    public static function getAllCategories(){
        /*require '../../connectToDatabase.php';

        $toReturn = array();

        foreach($conn->query("SELECT * FROM Genre") as $entry){
            $toReturn += $entry;
        }*/

        return /*$toReturn*/ "test";
    }

//}

?>