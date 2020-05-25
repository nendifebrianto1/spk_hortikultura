<?php
error_reporting(0);
class NilaiKriteria{
	
	private $conn;
	private $table_name = "nilaikriteria";
	
	public $id_tanaman;
	public $id_kriteria;
	public $nilai_kriteria;
	public $nilai_normalisasi;
	public $bobot_normalisasi;
	public $max;
	public $min;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//simpan data
	function insertNilaiKriteria(){
		
		$query = "insert into ".$this->table_name." values(?,?,?,'','')";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_tanaman);
		$stmt->bindParam(2, $this->id_kriteria);
		$stmt->bindParam(3, $this->nilai_kriteria);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	//menampilkan data
	function readNilaiKriteria(){

		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readKriteria1(){

		$query = "select id_tanaman, id_kriteria, nilai_kriteria from nilaikriteria where id_kriteria='K01'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readKriteria2(){

		$query = "select id_tanaman, id_kriteria, nilai_kriteria from nilaikriteria where id_kriteria='K02'";
		$stmt1 = $this->conn->prepare( $query );
		$stmt1->execute();
		
		return $stmt1;
	}
	
	function readKriteria3(){

		$query = "select id_tanaman, id_kriteria, nilai_kriteria from nilaikriteria where id_kriteria='K03'";
		$stmt2 = $this->conn->prepare( $query );
		$stmt2->execute();
		
		return $stmt2;
	}
	
	function readKriteria4(){

		$query = "select id_tanaman, id_kriteria, nilai_kriteria from nilaikriteria where id_kriteria='K04'";
		$stmt3 = $this->conn->prepare( $query );
		$stmt3->execute();
		
		return $stmt3;
	}
	
	function readKriteria5(){

		$query = "select id_tanaman, id_kriteria, nilai_kriteria from nilaikriteria where id_kriteria='K05'";
		$stmt4 = $this->conn->prepare( $query );
		$stmt4->execute();
		
		return $stmt4;
	}
	
	//memanggil data untuk proses perhitungan
	function readKhusus(){

		$query = "SELECT * FROM tanaman a, kriteria b, nilaikriteria c where a.id_tanaman=c.id_tanaman and b.id_kriteria=c.id_kriteria";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	//memanggil data untuk proses perhitungan
	function readR($a){

		$query = "SELECT * FROM tanaman a, kriteria b, nilaikriteria c where a.id_tanaman=c.id_tanaman and b.id_kriteria=c.id_kriteria and c.id_tanaman='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	//mencari nilai terbesar
	function readMax($b){
		
		$query = "SELECT max(nilai_kriteria) as max FROM " . $this->table_name . " WHERE id_kriteria='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	//mencari nilai terkecil
	function readMin($b){
		
		$query = "SELECT min(nilai_kriteria) as min FROM " . $this->table_name . " WHERE id_kriteria='$b' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	
	// memanggil id untuk update data
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_tanaman=? and id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_tanaman);
		$stmt->bindParam(2, $this->id_kriteria);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id_tanaman = $row['id_tanaman'];
		$this->id_kriteria = $row['id_kriteria'];
		$this->nilai_kriteria = $row['nilai_kriteria'];
	}
	
	// update data
	function updateNilaiKriteria(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET
					nilai_kriteria = :nilai_kriteria
				WHERE
					id_tanaman = :id_tanaman 
				AND
					id_kriteria = :id_kriteria";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_tanaman', $this->id_tanaman);
		$stmt->bindParam(':id_kriteria', $this->id_kriteria);
		$stmt->bindParam(':nilai_kriteria', $this->nilai_kriteria);
	
		
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	//proses update untuk menyimpan hasil normalisasi
	function normalisasi(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_normalisasi = :nilai_normalisasi,
					bobot_normalisasi = :bobot_normalisasi
				WHERE
					id_tanaman = :id_tanaman 
				AND
					id_kriteria = :id_kriteria";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nilai_normalisasi', $this->nilai_normalisasi);
		$stmt->bindParam(':bobot_normalisasi', $this->bobot_normalisasi);
		$stmt->bindParam(':id_tanaman', $this->id_tanaman);
		$stmt->bindParam(':id_kriteria', $this->id_kriteria);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete data
	function deleteNilaiKriteria(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_tanaman = ? and id_kriteria = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_tanaman);
		$stmt->bindParam(2, $this->id_kriteria);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	//cari data
	function cariNilaiKriteria(){
		include_once("class/class.koneksi.php");
		session_start();
		$cari = new koneksi;
		$cari -> doKoneksi2();
		?>
		
		<div id="main_content">
	<form method="post">
			<input type="text" name="cari" placeholder="ketik kode tanaman atau kode kriteria">
			<input type="submit" name="submit" value="CARI"> 
		</form><br>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Tanaman</th>
					<th>Kode Kriteria</th>
					<th>Nilai Kriteria</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
			if(!ISSET($_POST['submit'])){
			$i = 1;
			$query=mysql_query("select * from nilaikriteria");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
			?>
				<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo $row['nilai_kriteria']; ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
				</tr>
			<?php $i++; } }?>
			
			<?php if (ISSET($_POST['submit'])){
			$cari = $_POST['cari'];
			$i = 1;
			$query=mysql_query("SELECT * FROM nilaikriteria WHERE id_tanaman LIKE '%$cari%' OR id_kriteria LIKE '%$cari%'");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
			?>
			<tr>
					<td align="center" width="1%"><?php echo $i; ?></td>
					<td><?php echo $row['id_tanaman']; ?></td>
					<td><?php echo $row['id_kriteria']; ?></td>
					<td><?php echo $row['nilai_kriteria']; ?></td>
					<td>
						<a href="?page=edit_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman'];?> &id_kriteria=<?php echo $row['id_kriteria']; ?>"><img src="images/pencil.png" alt=""></a>
						<a href="?page=hapus_nilaikriteria&id_tanaman=<?php echo $row['id_tanaman']; ?> &id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')"><img src="images/cross.png" alt=""></a>
					</td>
			</tr>
			<?php }} ?>
			</tbody>
		</table>
</div>

<?php
}
}
?>
