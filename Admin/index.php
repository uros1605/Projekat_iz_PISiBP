<?php
include "klase.php";
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $korisnik = $metode->getUser($username, $password);
    if($korisnik != false){
        $_SESSION["id_korisnika"] = $korisnik["id_korisnika"];
        $_SESSION["uloga"] = $korisnik["uloga"];
        $_SESSION["ime_prezime"] = $korisnik["ime_prezime"];
        $_SESSION["email"] = $korisnik["email"];
        header("location:naslovna.php");
    }
    else{
        $greska = "Pogrešno ste uneli podatke";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Administracija - Login</title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Korisničko ime" required>
        <input type="password" name="password" placeholder="Lozinka" required>
        <?php if(isset($greska)){echo $greska;} ?>
        <input type="submit" name="submit" value="Uloguj se">
    </form>
    
</body>
</html>