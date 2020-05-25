<?php
error_reporting(0);
include_once("class/class.user.php");
session_start();
$cari = new User;
$cari -> cariUser();
?>

