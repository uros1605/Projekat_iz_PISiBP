<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Pregled urednika</title>
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
        $urednici = $metode->getSveUrednike();
        while($urednik = $urednici->fetch_assoc()) {
            echo "<div class=urednik_polje>";
            echo "<h3>$urednik[ime_prezime]</h3>";
            echo "<h3>$urednik[email]</h3>";
            echo "<h3>Rubrike</h3>";
            $rubrike_urednik = $metode->getUrednikRubrike($urednik["id_korisnika"]);
            if($rubrike_urednik != false){
                while($rubrika_urednik = $rubrike_urednik->fetch_assoc()){
                    $rubrika = $metode->getRubrikaByID($rubrika_urednik["id_rubrike"]);
                    echo "<p>$rubrika[naziv]</p>";
                }
            }
            else{
                echo "<p>Ovaj urednik nije ni u jednoj rubrici</p>";
            }
            echo "<div>
            <a href=izmena_korisnika.php?id_urednika=$urednik[id_korisnika]><button>Izmena urednika</button></a>
            <a href=brisanje_korisnika.php?id_korisnika=$urednik[id_korisnika]><button>Obriši</button></a>
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