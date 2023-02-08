<?php
        /*Call this Script for API Request*/
        require 'genrescript.php';
        $data = Genre::getAllGenres();
        $mydata='Variables declaration in PHP';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Get All Genres</title>
    <meta charset="utf-8">
</head>

<body>
    <!-- Form um sich einzuloggen-->
    
    <script type="text/javascript">
        alert("<?php echo $mydata?>");
    </script>
    
</body>

</html>
