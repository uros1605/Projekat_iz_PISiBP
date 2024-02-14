<?php
include "admin/klase.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje novine - pretraga vesti</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "wrapper-gore.php";
    ?>

    <section class="glavna">
        <div class="container_pretraga">
            <?php
            if (!empty($_POST["search"]) || !empty($_POST["datum"])) {
                $rezultat = 0;
                $vesti_niz = array();
                if (!empty($_POST["search"])) {
                    $vesti_naslov = $metode->pretragaVestiNaslov($_POST["search"]);

                    if ($vesti_naslov != false) {
                        $rezultat = 1;
                        while ($vest_naslov = $vesti_naslov->fetch_assoc()) {
                            array_push($vesti_niz, $vest_naslov["id_vesti"]);
                            echo "<div class=vest_pretraga>";
                            echo "<img src=$vest_naslov[slika_url]>";
                            echo "<h3><a href=procitaj_vest.php?id_vesti=$vest_naslov[id_vesti]&id_rubrike=$vest_naslov[id_rubrike]>$vest_naslov[naslov]</a></h3>";

                            echo "</div>";
                        }
                    }

                    $vesti_tagovi = $metode->getTagoviBySadrzaj($_POST["search"]);

                    if ($vesti_tagovi != false) {
                        $rezultat = 1;

                        while ($vest_tag = $vesti_tagovi->fetch_assoc()) {

                            if (!in_array($vest_tag["id_vesti"], $vesti_niz)) {
                                array_push($vesti_niz, $vest_tag["id_vesti"]);
                                $vest_iz_taga = $metode->getVestByID($vest_tag["id_vesti"]);
                                echo "<div class=vest_pretraga>";
                                echo "<img src=$vest_iz_taga[slika_url]>";
                                echo "<h3><a href=procitaj_vest.php?id_vesti=$vest_iz_taga[id_vesti]&id_rubrike=$vest_iz_taga[id_rubrike]>$vest_iz_taga[naslov]</a></h3>";
                                echo "</div>";
                            }
                        }
                    }
                }

                if (!empty($_POST["datum"])) {
                    $vesti_datum = $metode->pretragaVestiDatum($_POST["datum"]);
                    if ($vesti_datum != false) {
                        $rezultat = 1;
                        while ($vest_datum = $vesti_datum->fetch_assoc()) {
                            if (!in_array($vest_datum["id_vesti"], $vesti_niz)) {
                                array_push($vesti_niz, $vest_datum["id_vesti"]);
                                echo "<div class=vest_pretraga>";
                                echo "<img src=$vest_datum[slika_url]>";
                                echo "<h3><a href=procitaj_vest.php?id_vesti=$vest_datum[id_vesti]&id_rubrike=$vest_datum[id_rubrike]>$vest_datum[naslov]</a></h3>";
                                echo "</div>";
                            }
                        }
                    }
                }


                if ($rezultat == 0) {
                    echo "<p>Nema rezultata pretrage</p>";
                }
            } else {
                echo "<p>Niste uneli termin za pretragu</p>";
            }

            ?>
        </div>
    </section>

</body>

</html>