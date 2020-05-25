<?php
error_reporting(0);
class Tanaman{
	
	private $conn;
	private $table_name = "tanaman";
	public $id_tanaman;
	public $nama_tanaman;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//simpan data
	function insertTanaman(){
		
		$query = "insert into ".$this->table_name." values(?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_tanaman);
		$stmt->bindParam(2, $this->nama_tanaman);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	//memanmpilkan data
	function readTanaman(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_tanaman ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// memanggil id untuk update
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_tanaman=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_tanaman);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id_tanaman = $row['id_tanaman'];
		$this->nama_tanaman = $row['nama_tanaman'];
	}
	
	// untuk update 
	function updateTanaman(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_tanaman = :nama_tanaman
				WHERE
					id_tanaman = :id_tanaman";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nama_tanaman', $this->nama_tanaman);
		$stmt->bindParam(':id_tanaman', $this->id_tanaman);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// untuk delete data
	function deleteTanaman(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_tanaman = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_tanaman);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	//cari data
	function cariTanaman(){
		include_once("class/class.koneksi.php");
		session_start();
		$cari = new koneksi;
		$cari -> doKoneksi2();
		?>
		
	<div id="main_content">
	<form method="post">
			<input type="text" name="cari" placeholder="ketik kode tanaman atau nama">
			<input type="submit" name="submit" value="CARI"> 
		</form><br>
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
			if(!ISSET($_POST['submit'])){
			$i = 1;
			$query=mysql_query("select * from tanaman");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
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
			<?php $i++; } }?>
			
			<?php if (ISSET($_POST['submit'])){
			$cari = $_POST['cari'];
			$i = 1;
			$query=mysql_query("SELECT * FROM tanaman WHERE id_tanaman LIKE '%$cari%' OR nama_tanaman LIKE '%$cari%'");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
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
			<?php }} ?>
			</tbody>
		</table>
</div>
<?php
}
}
?>
