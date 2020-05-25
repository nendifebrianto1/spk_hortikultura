<?php
error_reporting(0);
include_once("class/class.koneksi.php");
$database = new koneksi();
$db = $database->doKoneksi();

include_once("class/class.tanaman.php");
$pro = new Tanaman($db);
$id_tanaman = isset($_GET['id_tanaman']) ? $_GET['id_tanaman'] : die('ERROR: missing ID.');
$pro->id_tanaman = $id_tanaman;
	
if($pro->deleteTanaman()){
	echo '<script>alert("Data Berhasil Dihapus!");
			document.location="?page=master_tanaman&success=true"; </script>';
} else{
	echo '<script>alert("Data Gagal Dihapus!");
			document.location="?page=master_tanaman&success=true"; </script>';
		
}
?>


