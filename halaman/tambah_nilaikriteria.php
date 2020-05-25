<?php
error_reporting(0);
include_once("class/class.tanaman.php");
$pgn1 = new Tanaman($db);
include_once("class/class.kriteria.php");
$pgn2 = new Kriteria($db);
if($_POST){
	
	include_once("class/class.nilaikriteria.php");
	$eks = new NilaiKriteria($db);
	
	$eks->id_tanaman = $_POST['id_tanaman'];
	$eks->id_kriteria = $_POST['id_kriteria'];
	$eks->nilai_kriteria = $_POST['nilai_kriteria'];
	
	if($eks->insertNilaiKriteria()){
		echo '<script>alert("Data Berhasil Disimpan!");
			document.location="?page=master_nilaikriteria&success=true"; </script>';
		}
	}
?>
<div id="main_content">
		<form id="input" method="post">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td align="right" width="30%"><h3>FORM TAMBAH NILAI KRITERIA</h3></td>
						<td width="1%"></td>
						<td></td>
					</tr>
					<tr>
						<td align="right" width="25%">Nama Tanaman</td>
						<td width="1%">:</td>
						<td>
							<select id="id_tanaman" name="id_tanaman">
								<?php
									$stmt3 = $pgn1->readTanaman();
									while ($row1 = $stmt3->fetch(PDO::FETCH_ASSOC)){
									extract($row1);
									echo "<option value='{$id_tanaman}'>{$nama_tanaman}</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Nama Kriteria</td>
						<td width="1%">:</td>
						<td>
							<select id="id_kriteria" name="id_kriteria">
								<?php
									$stmt2 = $pgn2->readKriteria();
									while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
									extract($row2);
									echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
								}
								?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td align="right" width="25%">Nilai Kriteria</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="nilai_kriteria" name="nilai_kriteria" size="25">
						</td>
						<td>Kriteria Modal Awal, Biaya Operasional, Harga Jual dan Keuntungan Bernilai Rupiah (Rp). 
							Contoh : jika nilainya 10.000, maka masukan nilai 10000 <br> <br>
							
							Untuk Kriteria Lama Panen nilainya berbentuk Hari, Contoh : jika lama panen 90 hari, maka masukan nilai 90
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
