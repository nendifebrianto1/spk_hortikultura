<?php  
error_reporting(0);
include_once("class/class.user.php");
$pro = new User($db);
$stmt = $pro->readUser();
?>

<div id="main_content">
		<a href="?page=tambah_user" class="button">TAMBAH DATA</a>
		<a href="?page=cari_user" class="button">CARI DATA USER</a>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode User</th>
					<th>Level User</th>
					<th>Nama Lengkap</th>
					<th>Username</th>
					<th>Password</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
				$i=1;
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_user']; ?></td>
					<td><?php echo $row['user_level']; ?></td>
					<td><?php echo $row['nama_lengkap']; ?></td>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['password']; ?></td>
					<td>
						<a href="?page=edit_user&id_user=<?php echo $row['id_user']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_user&id_user=<?php echo $row['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } ?>
			
			</tbody>
		</table>
</div>
