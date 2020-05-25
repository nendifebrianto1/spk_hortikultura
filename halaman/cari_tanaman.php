<?php
error_reporting(0);
include_once("class/class.tanaman.php");
session_start();
$cari = new Tanaman;
$cari -> cariTanaman();
?>
