<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if(isset($_GET["id_novinara"])) {
        $metode->obrisiNovinaruRubriku($_GET["id_novinara"],$_GET["id_rubrike"]);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Pregled novinara</title>
    <link rel="stylesheet" href="style.css">

        <script>
            function brisanjeNovinara(id_korisnika) {
                var r = confirm("Da li ste sigurni?");
                if (r == true) {
                    window.location.href = "brisanje_korisnika.php?id_korisnika=" + id_korisnika + "&status=novinar";
                }
            }
        </script>

</head>
<body>
    <section>
        <?php if ($_SESSION["uloga"] == "glavni urednik"): ?>
            <div class="main" style="position: relative;">
        <?php else: ?>
            <div style="position: relative; padding-top: 20px;"> 
        <?php endif; ?>
            <?php include "menu.php"; ?>
            <h1 class="pocetna_velika_slova" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php echo "PREGLED NOVINARA"; ?></h1>
        </div>
    <div class="main">
        <?php
        $novinari = $metode->getSveNovinare();
        while($novinar = $novinari->fetch_assoc()) {
            echo "<div class=novinar_polje>";
            echo "<h2>$novinar[ime_prezime]</h2>";
            echo "<h3>$novinar[email]</h3>";
            echo "<h3>Rubrike</h3>";
            $rubrike_novinar = $metode->getNovinarRubrike($novinar["id_korisnika"]);
            if($rubrike_novinar != false){
                while($rubrika_novinar = $rubrike_novinar->fetch_assoc()){
                    $rubrika = $metode->getRubrikaByID($rubrika_novinar["id_rubrike"]);
                    echo "<p>$rubrika[naziv] <a href=pregled_novinara.php?id_novinara=$novinar[id_korisnika]&id_rubrike=$rubrika[id_rubrike]><button class=dugme>Obriši rubriku</button></a></p>";
                }
            }
            else{
                echo "<p>Ovaj novinar nije ni u jednoj rubrici</p>";
            }
            echo "<h3>Broj članaka</h3>";
            $broj_clanaka = $metode->getBrojClanakaByNovinar($novinar["id_korisnika"]);
            echo "<h3>Broj članaka</h3>";
                    $broj_clanaka = $metode->getBrojClanakaByNovinar($novinar["id_korisnika"]);
                    echo "<p>$broj_clanaka[broj_clanaka]</p>";
                    echo "<div class=actions>
            <a href=izmena_novinara.php?id_novinara=$novinar[id_korisnika]><button class=dugme>Izmena novinara</button></a>";

                    echo "<button class=dugme onClick='brisanjeNovinara($novinar[id_korisnika])'>Obrisi</button>"
                    echo "<a href=promocija_novinar_urednik.php?id_novinara=$novinar[id_korisnika]><button class=dugme>Promocija novinara</button></a>
            </div>";
                    echo "</div>";
        }
        ?>
    </div>
    
    </section>
</body>
</html>

<?php
}

else{
    header("location:index.php");
}