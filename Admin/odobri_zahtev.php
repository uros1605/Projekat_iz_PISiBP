<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    $id_vesti = $_GET["id_vesti"];
    $id_zahteva = $_GET["id_zahteva"];
    $vrsta_zahteva = $_GET["vrsta_zahteva"];

    if ($vrsta_zahteva == "izmena") {

        $metode->azurirajStanjeVesti($id_vesti, "draft");
        $metode->obrisiZahtev($id_zahteva);
        header("location:naslovna.php");
    }

    if ($vrsta_zahteva == "brisanje") {

        $metode->obrisiVest($id_vesti);
        $metode->obrisiZahtev($id_zahteva);
        header("location:naslovna.php");
    }
} else {
    header("location:index.php");
}