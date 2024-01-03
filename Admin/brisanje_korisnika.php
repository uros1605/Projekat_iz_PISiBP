<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {




$id_korisnika = $_GET["id_korisnika"];
$status =  $_GET["status"];
$metode->obrisiKorisnika($id_korisnika);
if($status == "novinar"){
    header("location:pregled_novinara.php");
}
elseif($status == "urednik"){
    header("location:pregled_urednika.php");
}
}
else{
    header("location:index.php");
}