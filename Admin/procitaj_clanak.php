<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if (isset($_GET["vrsta"])) {
        $id_vesti = $_GET["id_vesti"];
        $id_novinara = $_GET["id_novinara"];
        $id_rubrike = $_GET["id_rubrike"];
        $vrsta = $_GET["vrsta"];
        $metode->posaljiZahtev($id_vesti, $id_rubrike, $id_novinara, $vrsta);
        $potvrda = "Vaš zahtev je poslat";
    }


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
        <section>
            <?php
            echo "<h2>$_SESSION[uloga]</h2>";
            include "menu.php";
            ?>
            <div class="clanak">
                <?php
                $id_vesti = $_GET["id_vesti"];
                $vest = $metode->getVestByID($id_vesti);
                echo "<h1>$vest[naslov]</h1>";
                if (isset($potvrda)) {
                    echo "<h3>$potvrda</h3>";
                }
                echo "<h3>$vest[datum_vreme]</h3>";
                echo "<div>$vest[sadrzaj]</div>";
                if ($_SESSION["uloga"] == "urednik" && $vest["stanje"] != "objavljen") {
                    echo "<a href=odobri_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>Odobri članak</button></a>";
                    echo "<a href=vrati_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>Vrati članak</button></a>";
                    echo "<a href=brisanje_vesti.php?id_vesti=$vest[id_vesti]><button class=dugme>Obriši članak</button></a>";
                }

                if ($_SESSION["uloga"] == "urednik" && isset($_GET["vrsta_zahteva"])) {
                    $vrsta_zahteva = $_GET["vrsta_zahteva"];
                    $id_zahteva = $_GET["id_zahteva"];

                    echo "<p>Zahtev: <b>$vrsta_zahteva</b>
                    
                    <a href=odobri_zahtev.php?id_vesti=$vest[id_vesti]&id_zahteva=$id_zahteva&vrsta_zahteva=$vrsta_zahteva><button class=dugme>Odobri zahtev</button></a>
                    
                    <a href=ponisti_zahtev.php?id_vesti=$vest[id_vesti]&id_zahteva=$id_zahteva&vrsta_zahteva=$vrsta_zahteva><button class=dugme>Poništi zahtev</button></a>
                    </p>";
                }

                if ($_SESSION["uloga"] == "novinar") {
                    $provera_vesti = $metode->getZahtevByIdVesti($id_vesti);
                    if ($provera_vesti == false) {
                        echo "<a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]&id_rubrike=$vest[id_rubrike]&id_novinara=$vest[id_novinara]&vrsta=izmena><button class=dugme>Pošalji zahtev za izmenu</button></a>";

                        echo "<a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]&id_rubrike=$vest[id_rubrike]&id_novinara=$vest[id_novinara]&vrsta=brisanje><button class=dugme>Pošalji zahtev za brisanje</button></a>";
                    }
                }
                ?>
            </div>

        </section>
    </body>

    </html>

<?php
} else {
    header("location:index.php");
}