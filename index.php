<?php
include "admin/klase.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje novine - naslovna stranica</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "wrapper-gore.php";
    ?>

    <section class="glavna">
        <div class="container">
            <div class="naslov">
                <h1>Dobrodošli na NEWS</h1>
                <?php
                $danasni_datum = date("d. M y.");
                echo "<h2>$danasni_datum</h2>";
                ?>
            </div>
            <div class="glavne_vesti">
                <?php
                $vesti5 = $metode->getPoslednjeVesti(5);
                $prva_vest = $vesti5->fetch_assoc();
                ?>

                <div class="prva_vest pseudolink" onclick="location='<?php echo "procitaj_vest.php?id_vesti=$prva_vest[id_vesti]&id_rubrike=$prva_vest[id_rubrike]"; ?>'">
                    <?php

                    echo "<img src=$prva_vest[slika_url]>";
                    echo "<h2>$prva_vest[naslov]</h2>";
                    $rubrika_vest = $metode->getRubrikaByID($prva_vest["id_rubrike"]);
                    echo "<a href=rubrika.php?id_rubrike=$rubrika_vest[id_rubrike]>$rubrika_vest[naziv]</a>";

                    ?>

                </div>

                <div class="vesti_blok_4">
                    <?php
                    while ($vest_4 = $vesti5->fetch_assoc()) {

                        echo "<div class='mala_vest pseudolink' onclick=location='procitaj_vest.php?id_vesti=$vest_4[id_vesti]&id_rubrike=$prva_vest[id_rubrike]'>";

                        echo "<img src=$vest_4[slika_url]>";
                        echo "<h4>$vest_4[naslov]</h4>";
                        $rubrika_vest = $metode->getRubrikaByID($vest_4["id_rubrike"]);
                        echo "<a href=rubrika.php?id_rubrike=$rubrika_vest[id_rubrike]>$rubrika_vest[naziv]</a>";

                        echo "</div>";
                    }
                    ?>
                </div>


            </div>

            <h2>Politika</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(1);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=1><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=1><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>


            <h2>Crna Hronika</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(3);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=3><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=3><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>

            <h2>Sport</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(2);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=2><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=2><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>

            <h2>Zabava</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(4);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=4><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=4><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>

            <h2>Kultura</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(5);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=5><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=5><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>

            <h2>Svet</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(6);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=6><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=6><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>

            <h2>Ekonomija</h2>
            <div class="rubrika_3">
                <?php
                $vesti_rubrika = $metode->getPoslednjeTriVestiIzRubrike(7);
                while ($vest_rubrika = $vesti_rubrika->fetch_assoc()) {
                    echo "<div class=rubrika_vest_blok>";
                    echo "<div class=rubrika_vest_blok_slika>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=7><img src=$vest_rubrika[slika_url]></a>";
                    echo "</div>";
                    echo "<a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=7><h3>$vest_rubrika[naslov]</h3></a>";
                    echo "</div>";
                }
                ?>
            </div>

        </div>
    </section>

</body>

</html>