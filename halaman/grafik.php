<?php
error_reporting(0);
include_once('class/class.koneksi.php');
$koneksi = new koneksi();
$koneksi -> doKoneksi2();

session_start();
include_once('class/class.perhitungan.php');
$perhitungan = new Perhitungan;
$perhitungan -> hasilperhitungan();

$q="select * from tanaman";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$lf=LF($h['id_tanaman']);
		$ef=EF($h['id_tanaman']);
		$nf=($lf-$ef);
		$arr_lf[]=$lf;
		$arr_ef[]=$ef;
		$arr_nf[]=$nf;
	}
}

$q="select * from tanaman";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$str->arr_alternatif_id[]=$h['id_tanaman'];
		$str->arr_alternatif_str[]=$h['nama_tanaman'];
		$lf=LF($h['id_tanaman']);
		$ef=EF($h['id_tanaman']);
		$nf=($lf-$ef);
		$persen=$nf*100;
		$rank_lf=0;$rank_ef=0;$rank_nf=0;
		for($i=0;$i<count($arr_lf);$i++){
			if($lf==$arr_lf[$i] and $rank_lf==0){$rank_lf=$i+1;}
			if($ef==$arr_ef[$i] and $rank_ef==0){$rank_ef=$i+1;}
			if($nf==$arr_nf[$i] and $rank_nf==0){$rank_nf=$i+1;}
		}
		$str->daftar_promethee1.='
		  <tr>
			<td>'.$h['nama_tanaman'].'</td>
			<td align="center">'.$persen.'</td>
		  </tr>
		';

		if($max<$persen){
			$max=$persen;
			$alternatif=$h['nama_tanaman'];
		}	  
	}
}

if(empty($str->daftar_promethee1)){
	$str->daftar_promethee1='<tr><td colspan="4"></td></tr>';
}

$q="select * from kriteria";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$str->arr_kriteria_id[]=$h['id_kriteria'];
		$str->arr_kriteria_str[]=$h['nama_kriteria'];
	}
}
?>
<html>
	<head>
		<script src="highcharts/code/highcharts.js"></script>
		<script src="highcharts/code/modules/data.js"></script>
		<script src="highcharts/code/modules/exporting.js"></script>
		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<link rel="stylesheet" type="text/css" href="tablesorter/style.css" media="print, projection, screen" />
	</head>
	
     <div id="main_content">
		<center><h4 style='background:#90EE90; border:0px; padding:10px'>HASIL ALTERNATIF</h4></center>
		<body>
		<table id="datatable" width="100%" border="1px" cellspacing="4" cellpadding="0" class="tablesorter">
		  <thead>
		  <tr bgcolor=#90EE90>
			<th align="center">Nama Tanaman</th>
			<th align="center">Persentase (%)</th>
		  </tr>
		  </thead>
		<tbody> 
		<?php echo $str->daftar_promethee1;?>
		</tbody> 
		</table>
		<br/>
		<h2>Hasil Grafik :</h2> 
		<?php echo  'Berdasarkan nilai Presentase, <strong>'.$alternatif.'</strong> menjadi alternatif Tanaman Pertama dengan nilai '.$max;?> %<br/>
		
<style type="text/css">
.lnk{font-weight:bold; font-family:arial; border:1px dotted #999999;padding:1px 2px 1px 2px;background-color:#FFFF99}
</style>
<br/>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto" >
<script type="text/javascript">
Highcharts.chart('container', {
data: {
table: 'datatable'
},
chart: {
type: 'column'
},
title: {
text: 'Grafik Hasil Alternatif'
}
});
</script>

<script>
    $(document).ready(function() 
        { 
            $("#datatable").tablesorter({sortList: [[1,1],[1,0]]}); 
        } 
    );
</script>
</body>
</div>
</div>
</html>
