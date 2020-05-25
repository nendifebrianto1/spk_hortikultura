<?php
error_reporting(0);
include_once("class/class.perhitungansaw.php");
$hasilperhitungansaw = new PerhitunganSAW($db);
$hasilperhitungansaw->hasilperhitungan();
?>
