

<!DOCTYPE html>
<html>

<head>
    <title>Get All Genres</title>
    <meta charset="utf-8">
</head>

<body>
    <!-- Form um sich einzuloggen-->
    <script>
        <?php
        /*Call this Script for API Request*/
        require 'genrescript.php';
        $data = Genre::getAllGenres();
        ?>
        JSON.stringify(<?php $mydata?>);
    </script>
    
</body>

</html>
