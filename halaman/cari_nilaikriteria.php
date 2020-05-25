<?php
error_reporting(0);
include_once("class/class.nilaikriteria.php");
session_start();
$cari = new NilaiKriteria;
$cari -> cariNilaiKriteria();
?>



