<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {




$id_korisnika = $_GET["id_korisnika"];
$metode->obrisiKorisnika($id_korisnika);
header("location:pregled_novinara.php");
}
else{
    header("location:index.php");
}