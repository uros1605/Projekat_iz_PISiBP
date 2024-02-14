<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if(isset($_GET["id_urednika"])) {
        $metode->obrisiUrednikuRubriku($_GET["id_urednika"],$_GET["id_rubrike"]);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Pregled urednika</title>
    <link rel="stylesheet" href="style.css">

        <script>
            function brisanjeUrednika(id_urednika) {
                var r = confirm("Da li ste sigurni?");
                if (r == true) {
                    window.location.href = "brisanje_korisnika.php?id_korisnika=" + id_urednika + "&status=urednik";
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
            <h1 class="pocetna_velika_slova" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php echo "PREGLED UREDNIKA"; ?></h1>
        </div>
    <div class="main">
        <?php
        $urednici = $metode->getSveUrednike();
        while($urednik = $urednici->fetch_assoc()) {
            echo "<div class=urednik_polje>";
            echo "<h2>$urednik[ime_prezime]</h2>";
            echo "<h3>$urednik[email]</h3>";
            echo "<h3>Rubrike</h3>";
            $rubrike_urednik = $metode->getUrednikRubrike($urednik["id_korisnika"]);
            if($rubrike_urednik != false){
                while($rubrika_urednik = $rubrike_urednik->fetch_assoc()){
                    $rubrika = $metode->getRubrikaByID($rubrika_urednik["id_rubrike"]);
                    echo "<p>$rubrika[naziv] <a href=pregled_urednika.php?id_urednika=$urednik[id_korisnika]&id_rubrike=$rubrika[id_rubrike]><button class=dugme>Obriši rubriku</button></a></p>";
                }
            }
            else{
                echo "<p>Ovaj urednik nije ni u jednoj rubrici</p>";
            }
            echo "<div>
            <a href=izmena_urednika.php?id_urednika=$urednik[id_korisnika]><button class=dugme>Izmena urednika</button></a>
            <button class=dugme onClick='brisanjeUrednika($urednik[id_korisnika])'>Obriši</button>
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