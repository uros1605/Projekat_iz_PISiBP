<?php
include "admin/klase.php";
$id_rubrike = $_GET["id_rubrike"];
$rubrika_info = $metode->getRubrikaByID($id_rubrike);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vesti iz rubrike - <?php echo $rubrika_info["naziv"]; ?></title>
    <link rel="stylesheet" ref="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "wrapper-gore.php";
    ?>

    <section class="glavna">
        <div class="container">
            <div class="naslov">
                <h1><?php echo $rubrika_info["naziv"]; ?></h1>
                <?php
                $danasni_datum = date("d. M y.");
                echo "<h2>$danasni_datum</h2>";
                echo " </div>";
                $vesti = $metode->getVestiByIDRubrike($id_rubrike, "objavljen");

                if ($vesti != false) {
                    echo "<div class=container_rubrika_vesti>";
                    while ($vest = $vesti->fetch_assoc()) {
                        echo "<div class='prva_vest pseudolink' onclick=location='procitaj_vest.php?id_vesti=$vest[id_vesti]&id_rubrike=$vest[id_rubrike]'>";
                        echo "<img src=$vest[slika_url]>";
                        echo "<h2>$vest[naslov]</h2>";
                        $rubrika_vest = $metode->getRubrikaByID($vest["id_rubrike"]);
                        echo "<a href=rubrika.php?id_rubrike=$rubrika_info[id_rubrike]>$rubrika_info[naziv]</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<h3>Nema vesti iz ove rubrike</h3>";
                }
                ?>


            </div>
    </section>

</body>

</html>