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
        <h3>Dodeli ili obrisi rubriku novinara</h3>
        <a href="dodela_rubrika_novinarima.php"><button>Dodeli</button></a>
    </div>
    <div class="polje">
        <h3>Dodeli ili obrisi rubriku urednicima</h3>
        <a href="dodela_rubrika_urednicima.php"><button>Dodeli</button></a>
    </div>
    <div class="polje">
        <h3>Promena statusa novinara</h3>
        <a href="promocija_novinar_urednik.php"><button>Promoviši</button></a>
    </div>
    </div>
    
    </section>
</body>
</html>

<?php
}

else{
    header("location:index.php");
}