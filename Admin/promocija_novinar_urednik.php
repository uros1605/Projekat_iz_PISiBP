<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if(isset($_POST["submit"])){
        $novinar_id = $_POST["novinar_id"];
        $rubrika_id = $_POST["rubrika_id"];
        $metode->unaprediNovinaraUUrednika($novinar_id);
        $metode->setUrednikRubrika($novinar_id, $rubrika_id);
        $metode->obrisiNovinaruRubrike($novinar_id);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Promocija novinara u urednika</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
        <?php if ($_SESSION["uloga"] == "glavni urednik"): ?>
            <div class="main" style="position: relative;">
        <?php else: ?>
            <div style="position: relative; padding-top: 20px;"> 
        <?php endif; ?>
            <?php include "menu.php"; ?>
            <h1 class="pocetna_velika_slova" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php echo "PROMENA STATUSA NOVINARA"; ?></h1>
        </div>
        
    <h3><?php if(isset($potvrda)) {echo $potvrda;} ?></h3>
    <form action="promocija_novinar_urednik.php" method="post" class="forma">
        <select name="novinar_id">
            <?php
            if(isset($_GET["id_novinara"])){
                $id_nivinara = $_GET["id_novinara"];
                $novinar = $metode->getNovinarByID($id_nivinara);
                echo "<option value=$novinar[id_korisnika]>$novinar[ime_prezime]</option>";
            }
            else{
            $novinari = $metode->getSveNovinare();
            if($novinari != false){
                while($novinar = $novinari->fetch_assoc()){
                    echo "<option value=$novinar[id_korisnika]>$novinar[ime_prezime]</option>";
                }
            }
            }
            ?>
        </select>
        <select name="rubrika_id">
        <?php
            $rubrike = $metode->getSveRubrike();
            if($rubrike != false){
                while($rubrika = $rubrike->fetch_assoc()){
                    echo "<option value=$rubrika[id_rubrike]>$rubrika[naziv]</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Dodeli rubriku" name="submit">
        <?php if(isset($greska)) {echo $greska;} ?>
    </form>
</body>
</html>

<?php
}

else{
    header("location:index.php");
}