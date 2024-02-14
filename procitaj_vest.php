<?php
include "admin/klase.php";
$id_vesti = $_GET["id_vesti"];
$vest = $metode->getVestByID($id_vesti);
$id_rubrike = $_GET["id_rubrike"];
$rubrika_podaci = $metode->getRubrikaByID($id_rubrike);

if (isset($_POST["submit"])) {
    $posetilac = $_POST["posetilac"];
    $sadrzaj = $_POST["sadrzaj"];
    $metode->posaljiKomentar($id_vesti, $posetilac, $sadrzaj);
    $potvrda = 1;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $vest["naslov"]; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "wrapper-gore.php";
    ?>

    <section class="glavna">
        <div class="container">
            <div class="naslov_citanje_vesti">
                <h1><?php echo $vest["naslov"]; ?></h1>
                <?php
                $danasni_datum = date("d. M y.");
                echo "<h2>$danasni_datum</h2>";
                ?>
            </div>
            <div class="citanje_vesti">
                <div class="cela_vest">

                    <div>
                        <?php
                        echo $vest["sadrzaj"]; ?>
                    </div>

                    <div class="lajkovi-dislajkovi">
                        <?php
                        echo "<p>Broj pozitivnih: $vest[broj_lajkova]";

                        if (!isset($_GET["lajk"])) {
                            echo "<a href=lajkuj_vest.php?id_vesti=$vest[id_vesti]&id_rubrike=$id_rubrike><i class='fa fa-thumbs-up lajk'></i></a>";
                        }

                        echo "</p>";

                        echo "<p>Broj negativnih: $vest[broj_dislajkova]";

                        if (!isset($_GET["lajk"])) {
                            echo "<a href=dislajkuj_vest.php?id_vesti=$vest[id_vesti]&id_rubrike=$id_rubrike><i class='fa fa-thumbs-down lajk'></i></a>";
                        }

                        echo "</p>";

                        ?>
                    </div>

                    <div class="komentari">
                        <?php
                        $komentari = $metode->getKomentariByVestID($id_vesti);
                        if ($komentari != false) {
                            while ($komentar = $komentari->fetch_assoc()) {
                                echo "<div class='komentar'>";
                                echo "<div class='komentar-info'>";
                                echo "<h5>$komentar[posetilac]</h5>";
                                echo "<p>$komentar[sadrzaj]</p>";
                                echo "<p>Broj pozitivnih: $komentar[broj_lajkova]</p>";

                                if (isset($_GET["id_komentara"])) {
                                    if ($_GET["id_komentara"] == $komentar["id_komentara"]) {
                                    } else {
                                        echo  "<a href='lajkuj_komentar.php?id_vesti=$vest[id_vesti]&id_rubrike=$id_rubrike&id_komentara=$komentar[id_komentara]' class='like-dislike'><i class='fa fa-thumbs-up'></i></a>";
                                    }
                                } else {
                                    echo  "<a href='lajkuj_komentar.php?id_vesti=$vest[id_vesti]&id_rubrike=$id_rubrike&id_komentara=$komentar[id_komentara]' class='like-dislike'><i class='fa fa-thumbs-up'></i></a>";
                                }

                                echo "<p>Broj negativnih: $komentar[broj_dislajkova]</p>";

                                if (isset($_GET["id_komentara"])) {
                                    if ($_GET["id_komentara"] == $komentar["id_komentara"]) {
                                    } else {
                                        echo  "<a href='dislajkuj_komentar.php?id_vesti=$vest[id_vesti]&id_rubrike=$id_rubrike&id_komentara=$komentar[id_komentara]' class='like-dislike'><i class='fa fa-thumbs-down'></i></a>";
                                    }
                                } else {
                                    echo  "<a href='dislajkuj_komentar.php?id_vesti=$vest[id_vesti]&id_rubrike=$id_rubrike&id_komentara=$komentar[id_komentara]' class='like-dislike'><i class='fa fa-thumbs-down'></i></a>";
                                }

                                echo "</div>"; // zatvara .komentar-info
                                echo "</div>"; // zatvara .komentar
                            }
                        } else {
                            echo "<p>Nema komentara na ovu vest</p>";
                        }
                        ?>
                    </div>

                    <?php
                    if (!isset($potvrda)) {
                    ?>
                        <div class="forma_pisanje_komenatar">
                            <form action="<?php echo "procitaj_vest.php?id_vesti=$id_vesti&id_rubrike=$id_rubrike" ?>" method="post">
                                <input type="text" name="posetilac" placeholder="Vaše ime" required>
                                <textarea name="sadrzaj" id="" cols="30" rows="10" placeholder="Vaš komentar" required></textarea>
                                <input type="submit" name="submit" value="Pošaljite komentar">
                            </form>
                        </div>

                    <?php
                    }
                    ?>


                </div>

                <div class="rubrika_desno">
                    <?php
                    echo "<h2>$rubrika_podaci[naziv]</h2>";
                    $vesti_iz_rubrike = $metode->getPoslednjeTriVestiIzRubrike($id_rubrike);
                    if ($vesti_iz_rubrike != false) {
                        while ($vest_rubrika = $vesti_iz_rubrike->fetch_assoc()) {
                            echo "
                        <div>
                        <h4><a href=procitaj_vest.php?id_vesti=$vest_rubrika[id_vesti]&id_rubrike=$id_rubrike>$vest_rubrika[naslov]</a></h4>
                        </div>
                        ";
                        }
                    } else {
                        echo "<p>Nema novih vesti iz ove rubrike</p>";
                    }

                    ?>
                </div>
            </div>

        </div>
    </section>

</body>

</html>