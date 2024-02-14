<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $ime_prezime = $_POST["ime_prezime"];
        $password = md5($_POST["password"]);
        $email = $_POST["email"];
        $id_novinara =$_GET["id_novinara"];
        $novinar = $metode->getNovinarByID($id_novinara);

        $korisnik = $metode->checkUser($username);
        if($korisnik == false || $username == $novinar["username"]){
            $metode->azurirajKorisnika($id_novinara, $username, $ime_prezime, $password, $email); 
            $potvrda = $ime_prezime." je ažuriran";
        }
        else{
            $greska = "Korisnik sa tim username-om već postoji";
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Izmena novinara</title>

</head>
<body>
    <?php
    include "menu.php";
    $id_novinara =$_GET["id_novinara"];
    $novinar = $metode->getNovinarByID($id_novinara);
    ?>
    <h3><?php if(isset($potvrda)) {echo $potvrda;} ?></h3>

    <form class="moja-forma" action="<?php echo "izmena_novinara.php?id_novinara=$id_novinara"; ?>" method="post">
        <input type="text" name="username" placeholder="unesi korisnicko ime"
        value ="<?php echo $novinar["username"]; ?>">
        <input type="text" name="ime_prezime" placeholder="ime i prezime"
        value ="<?php echo $novinar["ime_prezime"]; ?>">
        <input type="password" name="password" placeholder="lozinka"
        value ="<?php echo  $novinar["password"]; ?>">
        <input type="email" name="email" placeholder="email"
        value ="<?php echo  $novinar["email"]; ?>">
         
        <?php if(isset($greska)) {echo $greska;} ?> 
        <input type="submit" name="submit" value="Ažuriraj">  
    </form>
    
</body>
</html>

<?php
}

else{
    header("location:index.php");
}