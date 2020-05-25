<?php
error_reporting(0);
include_once("class/class.koneksi.php");
$database = new koneksi();
$db = $database->doKoneksi();

include_once("class/class.nilaikriteria.php");
$pro = new NilaiKriteria($db);
$id_tanaman = isset($_GET['id_tanaman']) ? $_GET['id_tanaman'] : die('ERROR: missing ID.');
$pro->id_tanaman = $id_tanaman;
$id_kriteria = isset($_GET['id_kriteria']) ? $_GET['id_kriteria'] : die('ERROR: missing ID.');
$pro->id_kriteria = $id_kriteria;
	
if($pro->deleteNilaiKriteria()){
	echo '<script>alert("Data Berhasil Dihapus!");
			document.location="?page=master_nilaikriteria&success=true"; </script>';
} else{
	echo '<script>alert("Data Gagal Dihapus!");
			document.location="?page=master_nilaikriteria&success=true"; </script>';
		
}
?>


