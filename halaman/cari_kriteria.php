<?php
error_reporting(0);
include_once("class/class.kriteria.php");
session_start();
$cari = new Kriteria;
$cari -> cariKriteria();
?>
