<?php
error_reporting(0);
if($_POST){
    include_once("class/class.user.php");
    $eks = new User($db);

    $eks->id_user = $_POST['id_user'];
    $eks->user_level = $_POST['user_level'];
    $eks->nama_lengkap = $_POST['nama_lengkap'];
    $eks->username = $_POST['username'];
    $eks->password = md5($_POST['password']);

    if($eks->password == md5($_POST['password'])){
    
    if($eks->insertUser()){
		echo '<script>alert("Data Berhasil Disimpan!");
			document.location="?page=master_user&success=true"; </script>';
		}
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
						<td align="right" width="25%"><h3>FORM TAMBAH USER</h3></td>
						<td width="1%"></td>
						<td></td>
					</tr>
					<tr>
						<td align="right" width="25%">Kode User</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="id_user" name="id_user" required="required" readonly="readonly" value="<?php echo (empty($eks['id_user'])) ? 
						$konf->buat_id("user", "id_user", "U") : $eks['id_user']; ?>" >
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Level User</td>
						<td width="1%">:</td>
						<td>
							<select id="user_level" name="user_level">
								<option>--Pilih--</option>
								<option value="koordinator">Koordinator Wira Tani</option>
								<option value="petani">Petani</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Nama Lengkap</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="nama_lengkap" name="nama_lengkap" size="25" required="required">
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Username</td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="username" name="username" size="25" required="required">
						</td>
					</tr>
					<tr>
						<td align="right" width="25%">Password</td>
						<td width="1%">:</td>
						<td>
							<input type="password" id="password" name="password" size="25" required="required">
						</td>
					</tr>
					<tr>
						<td align="right" width="20%"></td>
						<td width="1%"></td>
						<td>
							<input type="submit" name="simpan" value="SIMPAN" class="button">
							<input type="button" onclick="document.location='?page=master_user'" name="kembali" value="KEMBALI" class="button red">
						</td>
					</tr>
				</table>
			</form>
</div>
