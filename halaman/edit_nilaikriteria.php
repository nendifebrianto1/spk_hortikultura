<?php
error_reporting(0);
include_once("class/class.tanaman.php");
include_once("class/class.kriteria.php");
include_once("class/class.nilaikriteria.php");
$pgn1 = new Tanaman($db);
$pgn2 = new Kriteria($db);
$pgn3 = new NilaiKriteria($db);

$id_tanaman = isset($_GET['id_tanaman']) ? $_GET['id_tanaman'] : die('ERROR: missing ID.');
$id_kriteria = isset($_GET['id_kriteria']) ? $_GET['id_kriteria'] : die('ERROR: missing ID.');

include_once("class/class.nilaikriteria.php");
$eks = new NilaiKriteria($db);
$eks->id_tanaman = $id_tanaman;
$eks->id_kriteria = $id_kriteria;

$eks->readOne();

if($_POST){
	//$eks->id_tanaman = $_POST['id_tanaman'];
	//$eks->id_kriteria = $_POST['id_kriteria'];
	$eks->nilai_kriteria = $_POST['nilai_kriteria'];
	
	if($eks->updateNilaiKriteria()){
		echo '<script>alert("Data Berhasil Diedit!");
			document.location="?page=master_nilaikriteria&success=true"; </script>';
	}
}
?>

<div id="main_content">
<form id="input" method="post">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td align="right" width="25%"><h3>FORM EDIT NILAI KRITERIA</h3></td>
						<td width="1%"></td>
						<td></td>
					</tr>
					<tr>
						<td align="right" width="25%">Nilai Kriteria</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="nilai_kriteria" name="nilai_kriteria" value="<?php echo $eks->nilai_kriteria; ?>">
						</td>
					</tr>
					
					<tr>
						<td align="right" width="20%"></td>
						<td width="1%"></td>
						<td>
							<input type="submit" name="simpan" value="SIMPAN" class="button">
							<input type="button" onclick="document.location='?page=master_nilaikriteria'" name="kembali" value="KEMBALI" class="button red">
						</td>
					</tr>
				</table>
			</form>
</div>

