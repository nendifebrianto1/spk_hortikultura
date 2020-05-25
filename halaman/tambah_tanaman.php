<?php
error_reporting(0);
if($_POST){
	include_once("class/class.tanaman.php");
	$eks = new Tanaman($db);
	
	$eks->id_tanaman = $_POST['id_tanaman'];
	$eks->nama_tanaman = $_POST['nama_tanaman'];
	
	if($eks->insertTanaman()){
		echo '<script>alert("Data Berhasil Disimpan!");
			document.location="?page=master_tanaman&success=true"; </script>';
		}
	}
	
	include_once("class/class.koneksi.php");
		$konf = new koneksi;
		$kon = $konf->doKoneksi2();
?>
<div id="main_content">
	<form id="input" method="post">
				<table width="100%" cellpadding="0" cellspacing="0">
					
					<tr>
						<td align="right" width="25%"><h3>FORM TAMBAH TANAMAN</h3></td>
						<td width="1%"></td>
						<td></td>
					</tr>
					<tr>
						<td align="right" width="25%">Kode Tanaman</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="id_tanaman" name="id_tanaman" required="required" readonly="readonly" value="<?php echo (empty($eks['id_tanaman'])) ? 
						$konf->buat_id("tanaman", "id_tanaman", "A") : $eks['id_tanaman']; ?>">
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Nama Tanaman</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="nama_tanaman" name="nama_tanaman" size="25" required="required">
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
