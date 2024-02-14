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
    <link rel="stylesheet" href="style.css">
</head>
<body class="sredina">
    <div class="container">
        <form action="index.php" method="post" class="login-form">
            <h2>Prijavite se</h2>
            <div class="input-container">
                <input type="text" name="username" placeholder="Korisničko ime" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Lozinka" required>
            </div>
            <?php if(isset($greska)){echo '<p class="error">' . $greska . '</p>';} ?>
            <button type="submit" name="submit" class="btn-login">Uloguj se</button>
        </form>
    </div>
    
</body>
</html>