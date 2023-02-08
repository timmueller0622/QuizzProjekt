<?php
/*Call this Script for API Request*/
require 'genrescript.php';
$data = Genre::getAllGenres();
print_r(gettype($data));
$mydata = 'test';
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
        alert("<?php echo $data ?>");
    </script>
    
</body>

</html>
