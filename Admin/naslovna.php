<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Naslovna</title>

</head>
<body>
    <?php
    include "menu.php";
    ?>
    
</body>
</html>

<?php
}

else{
    header("location:index.php");
}