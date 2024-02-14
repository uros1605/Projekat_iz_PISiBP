<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administracija - Odobravanje članaka</title>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <section>
        <?php if ($_SESSION["uloga"] == "glavni urednik"): ?>
            <div class="main" style="position: relative;">
        <?php else: ?>
            <div style="position: relative; padding-top: 20px;">
        <?php endif; ?>
            <?php include "menu.php"; ?>
            <h1 class="pocetna_velika_slova" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php echo "ODOBRAVANJE ČLANAKA"; ?></h1>
        </div>
            <div>
                <h1>Članci koji čekaju odobrenje</h1>
                <?php
                $vesti = $metode->getVestiByStanje("odobrenje");
                if ($vesti != false) {
                    while ($vest = $vesti->fetch_assoc()) {
                        echo "<p>$vest[naslov]   <i>$vest[datum_vreme]</i> 
                            <a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>pročitaj članak</button></a>
                            
                            </p>";
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