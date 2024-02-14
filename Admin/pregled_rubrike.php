<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administracija - Dodela rubrika</title>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <?php
        include "menu.php";
        $id_rubrike = $_GET["rubrika"];
        $rubrika = $metode->getRubrikaByID($id_rubrike);

        ?>
        <section>
            <<?php if ($_SESSION["uloga"] == "glavni urednik"): ?>
            <div class="main" style="position: relative;">
        <?php else: ?>
            <div style="position: relative; padding-top: 20px;"> 
        <?php endif; ?>
            <?php include "menu.php"; ?>
            <h1 class="pocetna_velika_slova" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php echo "Rubrika:"." " . $rubrika["naziv"]; ?></h1>
        </div>
        
            <div class="prikaz_rubrike">
                <div class="kolona">
                    <h2>Lista novinara</h2>
                    <?php
                    $novinari = $metode->getNovinariByRubrika($id_rubrike);
                    if ($novinari != false) {
                        while ($novinar_info = $novinari->fetch_assoc()) {
                            $novinar = $metode->getNovinarByID($novinar_info["id_novinara"]);
                            echo "<p>$novinar[ime_prezime]</p>";
                        }
                    } else {
                        echo "Nema novinara u ovoj rubrici";
                    }
                    ?>
                </div>
                <div class="kolona">
                    <h2>Lista urednika</h2>
                    <?php
                    $urednici = $metode->getUredniciRubrike($id_rubrike);
                    if ($urednici != false) {
                        while ($urednik_info = $urednici->fetch_assoc()) {
                            $urednik = $metode->getNovinarByID($urednik_info["id_urednika"]);
                            echo "<p>$urednik[ime_prezime]</p>";
                        }
                    } else {
                        echo "Nema novinara u ovoj rubrici";
                    }
                    ?>
                </div>
                <div class="kolona">
                    <h2>Lista objavljenih članaka</h2>
                    <?php
                    $clanci = $metode->getVestiByIDRubrike($id_rubrike, "objavljen");
                    if ($clanci != false) {
                        while ($clanak = $clanci->fetch_assoc()) {
                            echo "<p>$clanak[naslov]
                            <a href=procitaj_clanak.php?id_vesti=$clanak[id_vesti]><button class=dugme>Pročitaj članak</button></a></p>
                            ";
                        }
                    } else {
                        echo "<p>Nema objavljenih članaka u ovoj rubrici</p>";
                    }
                    ?>
                </div>
                <div class="kolona">
                    <h2>Lista članaka koji čekaju odobrenje</h2>
                    <?php
                    $clanci = $metode->getVestiByIDRubrike($id_rubrike, "odobrenje");
                    if ($clanci != false) {
                        while ($clanak = $clanci->fetch_assoc()) {
                            echo "<p>$clanak[naslov]
                            <a href=procitaj_clanak.php?id_vesti=$clanak[id_vesti]><button class=dugme>Pročitaj članak</button></a></p>
                            ";
                        }
                    } else {
                        echo "<p>Nema članaka koji čekaju odobrenje u ovoj rubrici</p>";
                    }
                    ?>
                </div>

            </div>
        </section>
    </body>

    </html>

<?php
} else {
    header("location:index.php");
}
