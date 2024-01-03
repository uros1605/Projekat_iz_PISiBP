<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $ime_prezime = $_POST["ime_prezime"];
        $password = md5($_POST["password"]);
        $uloga = $_POST["uloga"];
        $email = $_POST["email"];

        $korisnik = $metode->checkUser($username);
        if($korisnik == false){
            $metode->setUser($username, $password, $ime_prezime, $uloga, $email); 
            $potvrda = $uloga." ".$ime_prezime." je kreiran";
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
    <title>Administracija - Kreiranje korisnika</title>

</head>
<body>
    <?php
    include "menu.php";
    ?>
    <h3><?php if(isset($potvrda)) {echo $potvrda;} ?></h3>

    <form action="kreiraj_korisnika.php" method="post">
        <input type="text" name="username" placeholder="unesi korisnicko ime">
        <input type="text" name="ime_prezime" placeholder="ime i prezime">
        <input type="password" name="password" placeholder="lozinka">
        <input type="email" name="email" placeholder="email">
        <label>Uloga</label>
        <select name="uloga">
            <option value="urednik">Urednik</option>
            <option value="novinar">Novinar</option>
        </select> 
        <?php if(isset($greska)) {echo $greska;} ?> 
        <input type="submit" name="submit" value="Kreiraj">  
    </form>
    
</body>
</html>

<?php
}

else{
    header("location:index.php");
}