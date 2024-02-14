<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if(isset($_POST["submit"])){
        $urednik_id = $_POST["urednik_id"];
        $rubrika_id = $_POST["rubrika_id"];
        if($metode->proveraUrednikRubrika($urednik_id, $rubrika_id) == false){
            $metode->setUrednikRubrika($urednik_id, $rubrika_id);
            $potvrda =  "Dodeljeno";
        }
        else{
            $greska = "Ovaj urednik već radi u ovoj rubrici";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Dodela rubrika</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
        <?php if ($_SESSION["uloga"] == "glavni urednik"): ?>
            <div class="main" style="position: relative;">
        <?php else: ?>
            <div style="position: relative; padding-top: 20px;">
        <?php endif; ?>
            <?php include "menu.php"; ?>
            <h1 class="pocetna_velika_slova" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php echo "DODELA RUBRIKA UREDNICIMA"; ?></h1>
        </div>
    <h3><?php if(isset($potvrda)) {echo $potvrda;} ?></h3>
    <form action="dodela_rubrika_urednicima.php" method="post" class="forma">
        <select name="urednik_id">
            <?php
            $urednici = $metode->getSveUrednike();
            if($urednici != false){
                while($urednik = $urednici->fetch_assoc()){
                    echo "<option value=$urednik[id_korisnika]>$urednik[ime_prezime]</option>";
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