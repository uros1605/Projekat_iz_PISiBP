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
    <section class="main">
    <?php
    echo "<h2>$_SESSION[uloga]</h2>";
    include "menu.php";
    ?>
    <div class="main">
        <?php
        if($_SESSION["uloga"] == "glavni urednik"){ 
        ?>
    <div class="polje">
        <h3>Pregled novinara</h3>
        <a href="pregled_novinara.php"><button>Pregled novinara</button></a>
    </div>
    <div class="polje">
        <h3>Pregled urednika</h3>
        <a href="pregled_urednika.php"><button>Pregled urednika</button></a>
    </div>
    <div class="polje">
        <h3>Pregled rubrika</h3>
        <a href="pregled_rubrika.php"><button>Pregled rubrika</button></a>
    </div>
    <div class="polje">
        <h3>Odobravanje članaka</h3>
        <a href="odobravanje_clanaka.php"><button>Odobravanje članaka</button></a>
    </div>
    <div class="polje">
        <h3>Registracija novog korisnika</h3>
        <a href="kreiraj_korisnika.php"><button>Kreiraj</button></a>
    </div>
    <div class="polje">
        <h3>Dodeli rubriku novinarima</h3>
        <a href="dodela_rubrika_novinarima.php"><button>Dodeli</button></a>
    </div>
    <div class="polje">
        <h3>Dodeli rubriku urednicima</h3>
        <a href="dodela_rubrika_urednicima.php"><button>Dodeli</button></a>
    </div>
    <div class="polje">
        <h3>Promena statusa novinara</h3>
        <a href="promocija_novinar_urednik.php"><button>Promoviši</button></a>
    </div>

    <?php
    }

    if($_SESSION["uloga"] == "novinar") {
        echo "<h2>".$_SESSION["ime_prezime"]."<h2>";
        echo "<h2>".$_SESSION["email"]."<h2>";
        $rubrike_novinar = $metode->getNovinarRubrike($_SESSION["id_korisnika"]);
            if($rubrike_novinar != false){
                while($rubrika_novinar = $rubrike_novinar->fetch_assoc()){
                    $rubrika = $metode->getRubrikaByID($rubrika_novinar["id_rubrike"]);
                    echo "<p>$rubrika[naziv]</p>";
                }
            }
            else{
                echo "<p>Ovaj novinar nije ni u jednoj rubrici</p>";
            }

    ?>
         <div class="polje">
            <h3>Napiši novi članak</h3>
            <a href="napisi_clanak.php"><button>Napiši</button></a>
        </div>
        <div class="polje">
            <h3>Lista članaka u draft stanju</h3>
            <?php
            $vesti_novinara_draft = $metode->getVestiByKorisnik($_SESSION["id_korisnika"], "draft");
            if ($vesti_novinara_draft != false) {
                while ($vest = $vesti_novinara_draft->fetch_assoc()) {
                     echo "<p>$vest[naslov] <a href=izmeni_vest.php?id_vesti=$vest[id_vesti]><button>Izmeni vest</button></a></p>";
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
                    echo "<p>$vest[naslov] <a href=procitaj_clanak.php?id_vesti=$vest[id_vesti]><button>pročitaj članak</button></a></p>";
                }
            } else {
                echo "<p>Nemate nijdan draft članak</p>";
            }
            ?>
        </div>

    <?php
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