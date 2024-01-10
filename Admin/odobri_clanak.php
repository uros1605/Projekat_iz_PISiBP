<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    $id_vesti = $_GET["id_vesti"];
    $metode->izmeniStanjeVesti($id_vesti, "objavljen");
    header("location:naslovna.php");
} else {
    header("location:index.php");
}