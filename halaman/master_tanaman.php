<?php
error_reporting(0);
include_once("class/class.koneksi.php");
session_start();
$config = new koneksi();
$db = $config->doKoneksi();

include_once("class/class.tanaman.php");
$pro = new Tanaman($db);
$stmt = $pro->readTanaman();
?>
<div id="main_content">
		<a href="?page=tambah_tanaman" class="button">TAMBAH DATA</a>
		<a href="?page=cari_tanaman" class="button">CARI DATA TANAMAN</a>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Nama Tanaman</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['nama_tanaman']; ?></td>
					<td>
						<a href="?page=edit_tanaman&id_tanaman=<?php echo $row['id_tanaman']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_tanaman&id_tanaman=<?php echo $row['id_tanaman']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			</tbody>
		</table>
</div>
