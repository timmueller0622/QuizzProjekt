<?php
        /*Call this Script for API Request*/
        require 'genrescript.php';
        $data = Genre::getAllGenres();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Get All Genres</title>
    <meta charset="utf-8">
</head>

<body>
    <!-- Form um sich einzuloggen-->
    
    <script>
        JSON.stringify(<?php $data?>);
    </script>
    
</body>

</html>
