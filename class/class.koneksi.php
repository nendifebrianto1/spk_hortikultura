<?php
error_reporting(0);
class koneksi{
	
	public 	$host = "localhost";
	private $db_name = "db_spk";
	private $username = "root";
	private $password = "";
	private $conn;
	
	public function doKoneksi(){
	
		$this->conn = null;
		
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->conn;
	}
	
	public function doKoneksi2(){
		mysql_connect($this->host, $this->username, $this->password);
		mysql_select_db($this->db_name);
	}
	
	function buat_id($tabel, $primary_key, $inisial){
			$kon = $this->doKoneksi2();
			// mengambil id terakhir di dalam tabel
			$last_id=mysql_query("select `$primary_key` from `$tabel` order by `$primary_key` desc limit 1");
			$dataLast=mysql_fetch_array($last_id);
			// parameter 0
			$nol = "00";

			$id_baru = str_replace($inisial, "", $dataLast[0]) + 1;

			$nol_baru = substr($nol, 0, 2 - strlen($id_baru));

			return $inisial.$nol_baru.$id_baru;
		}
}
?>
