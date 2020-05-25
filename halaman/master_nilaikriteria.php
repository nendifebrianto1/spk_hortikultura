<?php
error_reporting(0);
include_once("class/class.tanaman.php");
	$pro1 = new Tanaman($db);
	$stmt1 = $pro1->readTanaman();
		
include_once("class/class.kriteria.php");
	$pro2 = new Kriteria($db);
	$stmt2 = $pro2->readKriteria();
		
include_once("class/class.nilaikriteria.php");
	$pro = new NilaiKriteria($db);
	$stmtk1 = $pro->readKriteria1();
	$stmtk2 = $pro->readKriteria2();
	$stmtk3 = $pro->readKriteria3();
	$stmtk4 = $pro->readKriteria4();
	$stmtk5 = $pro->readKriteria5();
?>

<div id="main_content">
		<a href="?page=tambah_nilaikriteria" class="button">TAMBAH DATA</a>
		<a href="?page=cari_nilaikriteria" class="button">CARI DATA NILAI KRITERIA</a>
		<h3>Tabel Nilai Kriteria Modal Awal</h3>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Kode Kriteria</th>
					<th>Nilai Kriteria (Rp)</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmtk1->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo number_format($row['nilai_kriteria']); ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			
			</tbody>
		</table>
		
		<br/>
		<h3>Tabel Nilai Kriteria Biaya Operasional</h3>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Kode Kriteria</th>
					<th>Nilai Kriteria (Rp)</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmtk2->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo number_format($row['nilai_kriteria']); ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			
			</tbody>
		</table>
		
		<br/>
		<h3>Tabel Nilai Kriteria Lama Panen</h3>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Kode Kriteria</th>
					<th>Nilai Kriteria (Hari)</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmtk3->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo number_format($row['nilai_kriteria']); ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			
			</tbody>
		</table>
		
		<br/>
		<h3>Tabel Nilai Kriteria Harga Jual</h3>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Kode Kriteria</th>
					<th>Nilai Kriteria (Rp)</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmtk4->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo number_format($row['nilai_kriteria']); ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			
			</tbody>
		</table>
		
		<br/>
		<h3>Tabel Nilai Kriteria Keuntungan</h3>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Kode Kriteria</th>
					<th>Nilai Kriteria (Rp)</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmtk5->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo number_format($row['nilai_kriteria']); ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			
			</tbody>
		</table>
		
		<div style="visibility:hidden;" id="main_content">
		<?php
		include_once("class/class.perhitungansaw.php");
		$pro = new PerhitunganSAW;
		$pro->hasilperhitungan();
		?>
		</div>
