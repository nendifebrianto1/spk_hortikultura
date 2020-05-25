<?php
error_reporting(0);
include_once("class/class.koneksi.php");
session_start();
$config = new koneksi();
$db = $config->doKoneksi();


include_once("class/class.kriteria.php");
$pro = new Kriteria($db);
$stmt = $pro->readKriteria();
?>

	<div id="main_content">
		<a href="?page=tambah_kriteria" class="button">TAMBAH DATA</a>
		<a href="?page=cari_kriteria" class="button">CARI DATA KRITERIA</a>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Kriteria</th>
					<th>Nama Kriteria</th>
					<th>Tipe Kriteria</th>
					<th>Bobot Kriteria</th>
					<th>MinMax</th>
					<th>Tipe Preferensi</th>
					<th>Tools</th>
			</thead>
			<tbody>
				
			<?php
				$i=1;
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo $row['nama_kriteria']; ?></td>
					<td><?php echo $row['tipe_kriteria']; ?></td>
					<td><?php echo $row['bobot_kriteria']; ?></td>
					<td><?php echo $row['minmax']; ?></td>
					<td><?php echo $row['tipe_preferensi']; ?></td>
					<td>
						<a href="?page=edit_kriteria&id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_kriteria&id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; }?>
			
			
			
			
			</tbody>
		</table>
</div>
