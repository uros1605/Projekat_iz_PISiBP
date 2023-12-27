<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Pregled novinara</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <section>
    <?php
    echo "<h2>$_SESSION[uloga]</h2>";
    include "menu.php";

    ?>
    <div class="main">
        <?php
        $novinari = $metode->getSveNovinare();
        while($novinar = $novinari->fetch_assoc()) {
            echo "<div class=novinar_polje>";
            echo "<h3>$novinar[ime_prezime]</h3>";
            echo "<h3>$novinar[email]</h3>";
            echo "<h3>Rubrike</h3>";
            $rubrike_novinar = $metode->getNovinarRubrike($novinar["id_korisnika"]);
            if($rubrike_novinar != false){
                while($rubrika_novinar = $rubrike_novinar->fetch_assoc()){
                    $rubrika = $metode->getRubrikaByID($rubrika_novinar["id_rubrike"]);
                    echo "<p>$rubrika[naziv]</p>";
                }
            }
            else{
                echo "<p>Ovaj novinar nije ni u jednoj rubrici</p>";
            }
            echo "<h3>Broj članaka</h3>";
            $broj_clanaka = $metode->getBrojClanakaByNovinar($novinar["id_korisnika"]);
            echo "<p>$broj_clanaka[broj_clanaka]</p>";
            echo "<div>
            <a href=izmena_korisnika.php?id_novinara=$novinar[id_korisnika]><button>Izmena novinara</button></a>
            <a href=brisanje_korisnika.php?id_korisnika=$novinar[id_korisnika]><button>Obriši</button></a>
            <a href=promocija_novinar_urednik.php?id_novinara=$novinar[id_korisnika]><button>Promocija novinara</button></a>
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