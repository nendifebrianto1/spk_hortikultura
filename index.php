<?php
error_reporting(0);
include_once('class/class.koneksi.php');
$config = new koneksi();
$db = $config->doKoneksi();

if ($_POST) {

	include_once('class/class.akses.php');
	$login = new Akses($db);
	$login->userid = $_POST['username'];
	$login->passid = md5($_POST['password']);

	if ($login->login()) {
		echo "<script type=text/javascript>alert('Berhasil Login kedalam Sistem');
				   location.href='halaman.php';
				  </script>";
	} else {
		echo "<script>alert('Login Gagal!!! Pastikan username dan password sudah benar')</script>";
	}
}
?>
<html>

<head>
	<title>SPK Hortikultura</title>
	<link rel="stylesheet" type="text/css" href="style.css?v=6">
	<link rel='icon' type='image/png' href='images/wiratanilogo.png'>
</head>

<body>
	<br><br>
	<div align="center"><img src="images/wiratanibanner.svg?v=2" width="500" alt=""></div>
	<div align="center" style="margin-top:0px; font-size:24px; padding:0px;"><b>Sistem Pendukung Keputusan<br>
			Menentukan Peluang Usaha Pertanian Hortikultura</b></div>
	<div style="background:#BFBFBF; padding:5px;">
		<form method="post" id="login" class="login" style='border:3px solid #008000; border-radius:15px;'>
			<div style="padding:5px 15px;">
				<div align="center" style="color:#008000; padding:5px;">
					<img src="images/wiratanilogo.png?v=2" width="40" alt=""><br>
					<b>Wira Tani P4S Karawang</b>
				</div>
				<hr style='height:3px; background:#008000;'>
				<h3 align=center>LOGIN</h3>

				<label for="InputUsername1">Username</label>
				<input type="text" name="username" id="InputUsername1">
				<label for="InputPassword1">Password</label>
				<input type="password" name="password" id="InputPassword1">
				<center><input type="submit" name="login" value="LOGIN" class="button"></center>
		</form>
	</div>
	</div>
</body>

</html>