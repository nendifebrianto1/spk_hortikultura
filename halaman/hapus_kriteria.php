<?php
error_reporting(0);
include_once("class/class.koneksi.php");
$database = new koneksi();
$db = $database->doKoneksi();

include_once("class/class.kriteria.php");
$pro = new Kriteria($db);
$id_kriteria = isset($_GET['id_kriteria']) ? $_GET['id_kriteria'] : die('ERROR: missing ID.');
$pro->id_kriteria = $id_kriteria;
	
if($pro->deleteKriteria()){
	echo '<script>alert("Data Berhasil Dihapus!");
			document.location="?page=master_kriteria&success=true"; </script>';
} else{
	echo '<script>alert("Data Gagal Dihapus!");
			document.location="?page=master_kriteria&success=true"; </script>';
		
}
?>

