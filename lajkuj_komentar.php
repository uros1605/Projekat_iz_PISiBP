<?php
include "admin/klase.php";
$id_vesti = $_GET["id_vesti"];
$id_rubrike = $_GET["id_rubrike"];
$id_komentara = $_GET["id_komentara"];

$metode->lajkujKomentar($id_komentara);

header("location:procitaj_vest.php?id_vesti=$id_vesti&id_rubrike=$id_rubrike&lajk_k=1&id_komentara=$id_komentara");
