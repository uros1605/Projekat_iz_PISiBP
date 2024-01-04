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
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <section class="main">
            <?php
            echo "<h2>$_SESSION[uloga]</h2>";
            include "menu.php";
            ?>
            <div class="main">
                <?php
                $id_vesti = $_GET["id_vesti"];
                $vest = $metode->getVestByID($id_vesti);
                echo "<h1>$vest[naslov]</h1>";
                echo "<h3>$vest[datum_vreme]</h3>";
                echo "<div>$vest[sadrzaj]</div>";
                ?>
            </div>

        </section>
    </body>

    </html>

<?php
} else {
    header("location:index.php");
}