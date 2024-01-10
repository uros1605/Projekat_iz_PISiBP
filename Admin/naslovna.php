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
        <section>
            <?php

            include "menu.php";
            echo "<h2 class=pocetna_velika_slova>$_SESSION[uloga]</h2>";
            ?>

            <?php
            //segment za glavnog urednika
            if ($_SESSION["uloga"] == "glavni urednik") {
                echo "<div class=main>";
            ?>
                <div class="polje">
                    <h3>Pregled novinara</h3>
                    <a href="pregled_novinara.php"><button class="dugme">Pregled novinara</button></a>
                </div>
                <div class="polje">
                    <h3>Pregled urednika</h3>
                    <a href="pregled_urednika.php"><button class="dugme">Pregled urednika</button></a>
                </div>
                <div class="polje">
                    <h3>Pregled rubrika</h3>
                    <a href="pregled_rubrika.php"><button class="dugme">Pregled rubrika</button></a>
                </div>
                <div class="polje">
                    <h3>Odobravanje članaka</h3>
                    <a href="odobravanje_clanaka.php"><button class="dugme">Odobravanje članaka</button></a>
                </div>
                <div class="polje">
                    <h3>Registracija novog korisnika</h3>
                    <a href="kreiraj_korisnika.php"><button class="dugme">Kreiraj</button></a>
                </div>
                <div class="polje">
                    <h3>Dodeli rubriku novinarima</h3>
                    <a href="dodela_rubrika_novinarima.php"><button class="dugme">Dodeli</button></a>
                </div>
                <div class="polje">
                    <h3>Dodeli rubriku urednicima</h3>
                    <a href="dodela_rubrika_urednicima.php"><button class="dugme">Dodeli</button></a>
                </div>
                <div class="polje">
                    <h3>Promena statusa novinara</h3>
                    <a href="promocija_novinar_urednik.php"><button class="dugme">Promoviši</button></a>
                </div>
                </div>

            <?php
            }
            // segment za novinara
            if ($_SESSION["uloga"] == "novinar") {
                echo "<div>";
                echo "<h2>" . $_SESSION["ime_prezime"] . "<h2>";
                echo "<h2>" . $_SESSION["email"] . "<h2>";
                $rubrike_novinar = $metode->getNovinarRubrike($_SESSION["id_korisnika"]);
                if ($rubrike_novinar != false) {
                    while ($rubrika_novinar = $rubrike_novinar->fetch_assoc()) {
                        $rubrika = $metode->getRubrikaByID($rubrika_novinar["id_rubrike"]);
                        echo "<p>$rubrika[naziv]</p>";
                    }
                } else {
                    echo "<p>Ovaj novinar nije ni u jednoj rubrici</p>";
                }

                echo "</div>";

            ?>
                <div class="polje">
                    <h3>Napiši novi članak</h3>
                    <a href="napisi_clanak.php"><button class="dugme">Napiši</button></a>
                </div>
                <div class="polje">
                    <h3>Lista članaka u draft stanju</h3>
                    <?php
                    $vesti_novinara_draft = $metode->getVestiByKorisnik($_SESSION["id_korisnika"], "draft");
                    if ($vesti_novinara_draft != false) {
                        while ($vest = $vesti_novinara_draft->fetch_assoc()) {
                            echo "<p>$vest[naslov] <a href=izmeni_vest.php?id_vesti=$vest[id_vesti]><button class=dugme>Izmeni vest</button></a></p>";
                        }
                    } else {
                        echo "<p>Nemate nijdan draft članak</p>";
                    }
                    ?>
                </div>

                <div class="polje">
                    <h3>Lista članaka koji čekaju odobrenje</h3>
                    <?php
                    $vesti_novinara_draft = $metode->getVestiByKorisnik($_SESSION["id_korisnika"], "odobrenje");
                    if ($vesti_novinara_draft != false) {
                        while ($vest = $vesti_novinara_draft->fetch_assoc()) {
                            echo "<p>$vest[naslov] <a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>Pročitaj članak</button></a></p>";
                        }
                    } else {
                        echo "<p>Nemate nijdan članak koji čeka odobrenje</p>";
                    }
                    ?>
                </div>
                <div class="polje">
                    <h3>Lista objavljenih članaka</h3>
                    <?php
                    $vesti_novinara_draft = $metode->getVestiByKorisnik($_SESSION["id_korisnika"], "objavljen");
                    if ($vesti_novinara_draft != false) {
                        while ($vest = $vesti_novinara_draft->fetch_assoc()) {
                            echo "<p>$vest[naslov] <a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>Pročitaj članak</button></a></p>";
                        }
                    } else {
                        echo "<p>Nemate nijdan objavljen</p>";
                    }
                    ?>
                </div>

                <div class="polje">
                    <h3>Podaci o urednicima</h3>
                    <?php
                    $rubrike_novinar = $metode->getNovinarRubrike($_SESSION["id_korisnika"]);

                    while ($rubrika = $rubrike_novinar->fetch_assoc()) {

                        $urednici_rubrike = $metode->getUredniciRubrike($rubrika["id_rubrike"]);
                        if ($urednici_rubrike != false) {
                            while ($urednik_rubrike = $urednici_rubrike->fetch_assoc()) {
                                $urednik = $metode->getNovinarByID($urednik_rubrike["id_urednika"]);
                                echo "<h4>$urednik[ime_prezime]</h4>";
                                echo "<h5>$urednik[email]</h5>";
                            }
                        } else {
                            echo "<p>Ovaj novinar nema urednike</p>";
                        }
                    }
                    ?>
                </div>


            <?php
            }
            //segment za urednika

            if ($_SESSION["uloga"] == "urednik") {

                echo "<div>";
                echo "<h2>" . $_SESSION["ime_prezime"] . "<h2>";
                echo "<h2>" . $_SESSION["email"] . "<h2>";
                echo "<h2>Rubrike<h2>";
                $rubrike_urednik = $metode->getUrednikRubrike($_SESSION["id_korisnika"]);
                if ($rubrike_urednik != false) {
                    while ($rubrika_urednik = $rubrike_urednik->fetch_assoc()) {
                        $rubrika = $metode->getRubrikaByID($rubrika_urednik["id_rubrike"]);
                        echo "<p>$rubrika[naziv]</p>";
                    }
                } else {
                    echo "<p>Ovaj urednik nije ni u jednoj rubrici</p>";
                }
                echo "</div>";


            ?>
                <div class="polje">
                    <h3>Članci koji čekaju odobrenje</h3>
                    <?php
                    $rubrike_urednik = $metode->getUrednikRubrike($_SESSION["id_korisnika"]);
                    if ($rubrike_urednik != false) {
                        while ($rubrika_urednik = $rubrike_urednik->fetch_assoc()) {

                            $vesti_iz_rubrike = $metode->getVestiByIDRubrike($rubrika_urednik["id_rubrike"], "odobrenje");
                            if ($vesti_iz_rubrike != false) {
                                while ($vest = $vesti_iz_rubrike->fetch_assoc()) {
                                    echo "<p>$vest[naslov] 
                                        <a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>pročitaj članak</button></a>
                                        
                                        </p>";
                                }
                            }
                        }
                    } else {
                        echo "<p>Ovaj urednik nije ni u jednoj rubrici</p>";
                    }

                    ?>
                </div>

                <div class="polje">
                    <h3>Članci koji su objavljeni</h3>
                    <?php
                    $rubrike_urednik = $metode->getUrednikRubrike($_SESSION["id_korisnika"]);
                    if ($rubrike_urednik != false) {
                        while ($rubrika_urednik = $rubrike_urednik->fetch_assoc()) {

                            $vesti_iz_rubrike = $metode->getVestiByIDRubrike($rubrika_urednik["id_rubrike"], "objavljen");
                            if ($vesti_iz_rubrike != false) {
                                while ($vest = $vesti_iz_rubrike->fetch_assoc()) {
                                    echo "<p>$vest[naslov] 
                                        <a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]><button class=dugme>pročitaj članak</button></a>
                                        
                                        </p>";
                                }
                            }
                        }
                    } else {
                        echo "<p>Ovaj urednik nije ni u jednoj rubrici</p>";
                    }

                    ?>
                </div>

                <div class="polje">
                    <h3>Podaci o novinarima</h3>
                    <?php
                    $rubrike_urednik = $metode->getUrednikRubrike($_SESSION["id_korisnika"]);
                    if ($rubrike_urednik != false) {
                        while ($rubrika_urednik = $rubrike_urednik->fetch_assoc()) {
                            $novinari_rubrike = $metode->getNovinariByRubrika($rubrika_urednik["id_rubrike"]);
                            if ($novinari_rubrike != false) {
                                while ($novinar_rubrika = $novinari_rubrike->fetch_assoc()) {
                                    $novinar = $metode->getNovinarByID($novinar_rubrika["id_novinara"]);
                                    echo "<h4>$novinar[ime_prezime]</h4>";
                                    echo "<h5>$novinar[email]</h5>";
                                }
                            }
                        }
                    } else {
                        echo "<p>Ovaj urednik nije ni u jednoj rubrici</p>";
                    }

                    ?>
                </div>
            <?php
            }




            ?>


        </section>
    </body>

    </html>

<?php
} else {
    header("location:index.php");
}