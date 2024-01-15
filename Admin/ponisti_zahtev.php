<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {

    $id_zahteva = $_GET["id_zahteva"];


    $metode->obrisiZahtev($id_zahteva);
    header("location:naslovna.php");
} else {
    header("location:index.php");
}