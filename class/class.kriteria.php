<?php
error_reporting(0);
class Kriteria{
	
	private $conn;
	private $table_name = "kriteria";
	public $id_kriteria;
	public $nama_kriteria;
	public $tipe_kriteria;
	public $bobot_kriteria;
	public $minmax;
	public $tipe_preferensi;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//simpan data
	function insertKriteria(){
		$query = "insert into ".$this->table_name." values(?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_kriteria);
		$stmt->bindParam(2, $this->nama_kriteria);
		$stmt->bindParam(3, $this->tipe_kriteria);
		$stmt->bindParam(4, $this->bobot_kriteria);
		$stmt->bindParam(5, $this->minmax);
		$stmt->bindParam(6, $this->tipe_preferensi);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}		
	}
	
	//menampilkan data
	function readKriteria(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
		
	// memanggil id untuk update
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_kriteria);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id_kriteria = $row['id_kriteria'];
		$this->nama_kriteria = $row['nama_kriteria'];
		$this->tipe_kriteria = $row['tipe_kriteria'];
		$this->bobot_kriteria = $row['bobot_kriteria'];
		$this->minmax = $row['minmax'];
		$this->tipe_preferensi = $row['tipe_preferensi'];
	}
	
	// untuk update
	function updateKriteria(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_kriteria = :nama_kriteria,
					tipe_kriteria = :tipe_kriteria,
					bobot_kriteria = :bobot_kriteria,
					minmax = :minmax,
					tipe_preferensi = :tipe_preferensi
				WHERE
					id_kriteria = :id_kriteria";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nama_kriteria', $this->nama_kriteria);
		$stmt->bindParam(':tipe_kriteria', $this->tipe_kriteria);
		$stmt->bindParam(':bobot_kriteria', $this->bobot_kriteria);
		$stmt->bindParam(':minmax', $this->minmax);
		$stmt->bindParam(':tipe_preferensi', $this->tipe_preferensi);
		$stmt->bindParam(':id_kriteria', $this->id_kriteria);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete data
	function deleteKriteria(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_kriteria = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_kriteria);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	//cari data
	function cariKriteria(){
		include_once("class/class.koneksi.php");
		session_start();
		$cari = new koneksi;
		$cari -> doKoneksi2();
		?>
		
	<div id="main_content">
	<form method="post">
			<input type="text" name="cari" placeholder="ketik kode kriteria atau nama">
			<input type="submit" name="submit" value="CARI"> 
		</form><br>
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
			if(!ISSET($_POST['submit'])){
			$i = 1;
			$query=mysql_query("select * from kriteria");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
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
			<?php $i++; } }?>
			
			<?php if (ISSET($_POST['submit'])){
			$cari = $_POST['cari'];
			$i = 1;
			$query=mysql_query("SELECT * FROM kriteria WHERE id_kriteria LIKE '%$cari%' OR nama_kriteria LIKE '%$cari%'");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
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
			<?php }} ?>
			</tbody>
		</table>
		</div>	
	<?php		
	}
}
?>
