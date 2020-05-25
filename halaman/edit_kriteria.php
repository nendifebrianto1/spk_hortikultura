<?php
error_reporting(0);
$id_kriteria = isset($_GET['id_kriteria']) ? $_GET['id_kriteria'] : die('ERROR: missing ID.');

include_once("class/class.kriteria.php");
$eks = new Kriteria($db);
$eks->id_kriteria = $id_kriteria;

$eks->readOne();
if($_POST){

	$eks->id_kriteria = $_POST['id_kriteria'];
	$eks->nama_kriteria = $_POST['nama_kriteria'];
	$eks->tipe_kriteria = $_POST['tipe_kriteria'];
	$eks->bobot_kriteria = $_POST['bobot_kriteria'];
	$eks->minmax = $_POST['minmax'];
	$eks->tipe_preferensi = $_POST['tipe_preferensi'];
	
	if($eks->updateKriteria()){
		echo '<script>alert("Data Berhasil Diedit!");
			document.location="?page=master_kriteria&success=true"; </script>';
	}
}
?>
<div id="main_content">
			<form id="input" method="post">
				<table width="100%" cellpadding="0" cellspacing="0">
					
					<tr>
						<td align="right" width="25%"><h3>FORM EDIT KRITERIA</h3></td>
						<td width="1%"></td>
						<td></td>
					</tr>
					<tr>
						<td align="right" width="25%">Kode Kriteria</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="id_kriteria" name="id_kriteria" value="<?php echo $eks->id_kriteria; ?>">
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Nama Kriteria</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="nama_kriteria" name="nama_kriteria" value="<?php echo $eks->nama_kriteria; ?>">
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Tipe Kriteria</td>
						<td width="1%">:</td>
						<td>
							<select id="tipe_kriteria" name="tipe_kriteria">
								<option>--Pilih--</option>
								<option value="benefit">Benefit</option>
								<option value="cost">Cost</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Bobot Kriteria</td>
						<td width="1%">:</td>
						<td>
							<input type="number" step="0.05" id="bobot_kriteria" name="bobot_kriteria" value="<?php echo $eks->bobot_kriteria; ?>">
						Bobot tidak boleh lebih dari 1
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">MinMax</td>
						<td width="1%">:</td>
						<td>
							<select id="minmax" name="minmax">
								<option>--Pilih--</option>
								<option value="max">Max</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Tipe Preferensi</td>
						<td width="1%">:</td>
						<td>
							<select id="tipe_preferensi" name="tipe_preferensi">
								<option>--Pilih--</option>
								<option value="1">1</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right" width="20%"></td>
						<td width="1%"></td>
						<td>
							<input type="submit" name="simpan" value="SIMPAN" class="button">
							<input type="button" onclick="document.location='?page=master_kriteria'" name="kembali" value="KEMBALI" class="button red">
						</td>
					</tr>
				</table>
			</form>
			</div>
