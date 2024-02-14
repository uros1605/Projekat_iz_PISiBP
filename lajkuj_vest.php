<?php
include "admin/klase.php";
$id_vesti = $_GET["id_vesti"];
$id_rubrike = $_GET["id_rubrike"];
$metode->lajkujVest($id_vesti);
header("location:procitaj_vest.php?id_vesti=$id_vesti&id_rubrike=$id_rubrike&lajk=1");
