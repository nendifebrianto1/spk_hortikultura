<?php
error_reporting(0);
class PerhitunganSAW {
	function hasilperhitungan() { 
		session_start();
		$config = new koneksi();
		$db = $config->doKoneksi();
		
		include_once("class.tanaman.php");
		$pro1 = new Tanaman($db);
		$stmt1 = $pro1->readTanaman();
		$stmt1x = $pro1->readTanaman();
		$stmt1y = $pro1->readTanaman();
		
		include_once("class.kriteria.php");
		$pro2 = new Kriteria($db);
		$stmt2 = $pro2->readKriteria();
		$stmt2x = $pro2->readKriteria();
		$stmt2y = $pro2->readKriteria();
		$stmt2yx = $pro2->readKriteria();
		
		include_once("class.nilaikriteria.php");
		$pro = new NilaiKriteria($db);
		$stmt 	= $pro->readKhusus();
		?>
		
		<div id="main_content">
	    	<table width="100%" border="1" cellpadding="8" >
			<thead>
			<h4>Rating Kecocokan Setiap Alternatif</h4>
					<tr>
		                <th rowspan="2"><b>Nama Tanaman</b></th>
		                <th colspan="<?php echo $stmt2x->rowCount(); ?>" ><b>Nama Kriteria</b></th>
					</tr>
					<tr>
		             <?php
					while ($row2x = $stmt2x->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><b><?php echo $row2x['nama_kriteria'] ?><br/>(<?php echo $row2x['tipe_kriteria'] ?>)</b></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		        <tbody>
		        <?php
				while ($row1x = $stmt1x->fetch(PDO::FETCH_ASSOC)){
					?>
		            <tr>
		                <th><?php echo $row1x['nama_tanaman'] ?></th>
		                <?php
		                $ax= $row1x['id_tanaman'];
						$stmtrx = $pro->readR($ax);
						while ($rowrx = $stmtrx->fetch(PDO::FETCH_ASSOC)){
						?>
		                <td>
		                	<?php 
		                	echo number_format($rowrx['nilai_kriteria']);
		                	?>
		                </td>
		                <?php
		                }
						?>
		            </tr>
				<?php
				}
				?>
		    </table>
		
			<br/>
	
	    	<table width="100%" border="1" cellpadding="8">
			<thead>
				<h4>Normalisasi R Perangkingan</h4>
					<tr>
		                <th rowspan="2"><b>Nama Tanaman</b></th>
		                <th colspan="<?php echo $stmt2->rowCount(); ?>" ><b>Nama Kriteria</b></th>
					</tr>
					<tr>
		            <?php
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><b><?php echo $row2['nama_kriteria'] ?></b></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		        <tbody>
				<?php
				while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
				?>
		            <tr>
		                <th><?php echo $row1['nama_tanaman'] ?></th>
		                <?php
		                $a= $row1['id_tanaman'];
						$stmtr = $pro->readR($a);
						while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
							$b = $rowr['id_kriteria'];
							$tipe_kriteria = $rowr['tipe_kriteria'];
							$bobot_kriteria = $rowr['bobot_kriteria'];
						?>
		                <td>
		                	<?php 
		                	if($tipe_kriteria=='benefit'){
		                		$stmtmax = $pro->readMax($b);
								$maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
								echo round($nor =$rowr['nilai_kriteria']/$maxnr['max'],3);
							} else{
								$stmtmin = $pro->readMin($b);
								$minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
								echo round($nor = $minnr['min']/$rowr['nilai_kriteria'],3);
							}
							$pro->id_tanaman = $a;
							$pro->id_kriteria = $b;
							$pro->nilai_normalisasi = $nor;
							$pro->bobot_normalisasi = $bobot_kriteria*$nor;
							$pro->normalisasi();
		                	?>
		                </td>
		                
		                <?php
		                }
						?>
						
					<?php
					}
					?>
					<tr>
		                <th><b>Bobot Kriteria</b></th>
						<?php
							while ($row2yx = $stmt2yx->fetch(PDO::FETCH_ASSOC)){
							?>
		                <td><b><?php echo $row2yx['bobot_kriteria'] ?></b></td>
		            <?php
					}
					?>
					</tr>
		        </tbody>
		    </table>
		    
		    <br/>
	   
	    	<table width="100%" border="1" cellpadding="8">
			<thead>
				<h4>Perhitungan Nilai Preferensi<h4>
					<tr>
		                <th rowspan="2"><b>Nama Tanaman</b></th>
		                <th colspan="<?php echo $stmt2y->rowCount(); ?>" >Nama Kriteria</th>
					</tr>
					<tr>
		             <?php
					while ($row6 = $stmt2y->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><b><?php echo $row6['nama_kriteria'] ?></b></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		        <tbody>
				<?php
				while ($row5 = $stmt1y->fetch(PDO::FETCH_ASSOC)){
				?>
		            <tr>
		                <th><?php echo $row5['nama_tanaman'] ?></th>
		                <?php
		                $a= $row5['id_tanaman'];
						$stmtr = $pro->readR($a);
						while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
						?>
		                <td>
		                	<?php 
		                	echo round($rowr['bobot_normalisasi'],4);
		                	?>
		                </td>
		                <?php
		                }
						?>
		            </tr>
				<?php
				}
				?>
		        </tbody>
		    </table>
</div>
	
	
<?php } }?>
