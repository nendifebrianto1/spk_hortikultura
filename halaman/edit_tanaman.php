<?php
error_reporting(0);
$id_tanaman = isset($_GET['id_tanaman']) ? $_GET['id_tanaman'] : die('ERROR: missing ID.');
include_once("class/class.tanaman.php");
$eks = new Tanaman($db);
$eks->id_tanaman = $id_tanaman;
$eks->readOne();

if($_POST){

	$eks->id_tanaman = $_POST['id_tanaman'];
	$eks->nama_tanaman = $_POST['nama_tanaman'];
	
	if($eks->updateTanaman()){
		echo '<script>alert("Data Berhasil Diedit!");
			document.location="?page=master_tanaman&success=true"; </script>';
	}
}
?>
<div id="main_content">
			<form id="input" method="post">
				<table width="100%" cellpadding="0" cellspacing="0">
					
					<tr>
						<td align="right" width="25%"><h3>FORM EDIT TANAMAN</h3></td>
						<td width="1%"></td>
						<td></td>
					</tr>
					<tr>
						<td align="right" width="25%">Kode Tanaman</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="id_tanaman" name="id_tanaman" readonly="readonly" value="<?php echo $eks->id_tanaman; ?>">
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Nama Tanaman</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="nama_tanaman" name="nama_tanaman" value="<?php echo $eks->nama_tanaman; ?>">
						</td>
					</tr>
					<tr>
						<td align="right" width="20%"></td>
						<td width="1%"></td>
						<td>
							<input type="submit" name="simpan" value="SIMPAN" class="button">
							<input type="button" onclick="document.location='?page=master_tanaman'" name="kembali" value="KEMBALI" class="button red">
						</td>
					</tr>
				</table>
			</form>
</div>
