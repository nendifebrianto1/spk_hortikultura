<?php
class User{
	
	private $conn;
	private $table_name = "user";
	public $id_user;
	public $user_level;
	public $nama_lengkap;
	public $username;
	public $password;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//simpan data
	function insertUser(){
		
		$query = "insert into ".$this->table_name." values(?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_user);
		$stmt->bindParam(2, $this->user_level);
		$stmt->bindParam(3, $this->nama_lengkap);
		$stmt->bindParam(4, $this->username);
		$stmt->bindParam(5, $this->password);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	//menampilkan data
	function readUser(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_user ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// memanggil id untuk update
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_user=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_user);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id_user = $row['id_user'];
		$this->user_level = $row['user_level'];
		$this->nama_lengkap = $row['nama_lengkap'];
		$this->username = $row['username'];
		$this->password = $row['password'];
	}
	
	// update data
	function updateUser(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					user_level = :user_level, 
					nama_lengkap = :nama_lengkap, 
					username = :username, 
					password = :password
				WHERE
					id_user = :id_user";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_level', $this->user_level);
		$stmt->bindParam(':nama_lengkap', $this->nama_lengkap);
		$stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':password', $this->password);
		$stmt->bindParam(':id_user', $this->id_user);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete data
	function deleteUser(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_user = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_user);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	//cari data
	function cariUser(){
		include_once("class/class.koneksi.php");
		session_start();
		$cari = new koneksi;
		$cari -> doKoneksi2();
		?>
		
		<div id="main_content">
	<form method="post">
			<input type="text" name="cari" placeholder="ketik kode user atau nama">
			<input type="submit" name="submit" value="CARI"> 
		</form><br>
		<table width="100%" id="data" border="1" cellpadding="8">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode User</th>
					<th>Nama Lengkap</th>
					<th>Username</th>
					<th>Password</th>
					<th>Tools</th>
			</thead>
			<tbody>
			<?php
			if(!ISSET($_POST['submit'])){
			$i = 1;
			$query=mysql_query("select * from user");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
				
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
			<?php $i++; } }?>
			
			<?php if (ISSET($_POST['submit'])){
			$cari = $_POST['cari'];
			$i = 1;
			$query=mysql_query("SELECT * FROM user WHERE id_user LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%'");
			$jmquery=mysql_num_rows($query);
			for($a=0; $a<$jmquery; $a++){
				$row=mysql_fetch_array($query);
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
			<?php }} ?>
			</tbody>
		</table>
</div>

<?php
}
}
?>
