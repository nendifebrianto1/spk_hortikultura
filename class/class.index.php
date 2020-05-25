<?php
error_reporting(0);
class Index
{
	public function halaman()
	{

		include("class/class.koneksi.php");
		session_start();
		if (!isset($_SESSION)) {
			echo "<script>location.href='index.php'</script>";
		}
		$config = new koneksi();
		$db = $config->doKoneksi();
?>
		<!DOCTYPE html>

		<head>
			<title>SPK Hortikultura</title>
			<link rel="stylesheet" href="style.css?v=7">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel='icon' type='image/png' href='images/wiratanilogo.png'>

			<script>
				// inisialisasi kesiapan dokumen

				$(function() {
					// semua table yang mengandung id = data, akan berubah jadi super seiya
					$('table#data').DataTable();
				});
			</script>
		</head>

		<body>
			<div id="header">
				<div id="info_user">
				</div>

			</div>
			<div id="sidebar">
				<span><b>*Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>.*</b></span>
				<div id="logo">
				</div>
				<div id="menu">
					<ul>
						<?php if ($_SESSION['user_level'] == 'koordinator' || $_SESSION['user_level'] == 'petani') { ?>
							<h3>--KELOLA DATA--</h3>
							<?php if ($_SESSION['user_level'] == 'koordinator') { ?>
								<li><a href="?page=master_kriteria"><i class="fa fa-archive"></i> Data Kriteria</a></li>
							<?php } ?>
							<li><a href="?page=master_tanaman"><i class="fa fa-archive"></i> Data Tanaman</a></li>
							<li><a href="?page=master_nilaikriteria"><i class="fa fa-archive"></i> Data Nilai Kriteria</a></li>
							<?php if ($_SESSION['user_level'] == 'petani') { ?>
								<li><a href="?page=master_user"><i class="fa fa-user"></i> Data User</a></li>
							<?php } ?>
							<h3>--PERHITUNGAN--</h3>
							<li><a href="?page=master_perhitungan2"><i class="fa fa-calculator"></i> Hasil Perhitungan </a></li>
							<h3>--CETAK--</h3>
							<li><a href="?page=cetak"><i class="fa fa-print"></i> Cetak Perhitungan</a></li>
							<h3>--INFO PROGRAM--</h3>
							<li><a href="?page=profil"><i class="fa fa-user"></i> Profil</a></li>
							<li><a href="?page=tentang"><i class="fa fa-info"></i> Tentang</a></li>
							<li><a href="?page=bantuan"><i class="fa fa-info"></i> Bantuan</a></li>
							<h3>--LOGOUT--</h3>
							<li><a href="?page=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>

			<div id="content">

				<?php
				// jika tidak di menu apapun
				if (!isset($_GET['page'])) {
					// include dashboard
					include "halaman/beranda.php";
					// jika sedang di menu
				} else {
					// jika file yang diperlukan ada
					if (file_exists("halaman/$_GET[page].php"))
						// include halaman yang dperlukan
						include "halaman/$_GET[page].php";
					else
						// jika tidak ada, maka include dashboard
						include "halaman/dashboard.php";
				}
				?>
			</div>
			<div id="footer">Copyleft @ 2019 STMIK Kharisma Karawang</div>
		</body>

		</html>

<?php
	}
}
?>