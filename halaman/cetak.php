<?php
error_reporting(0);
echo" <body onload='window.print()'> ";
include_once('class/class.cetak.php');
	$cetak = new Cetak();
	$cetak -> cetakhasilperhitungan();
?>
