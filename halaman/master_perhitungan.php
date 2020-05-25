<?php
error_reporting(0);
	include_once('class/class.koneksi.php');
	$koneksi = new koneksi();
	$koneksi -> doKoneksi2();

session_start();
include_once('class/class.perhitungan.php');
$perhitungan = new Perhitungan;
$perhitungan -> hasilperhitungan();
$tb_header='<td align="center"></td>';
$tb_header1='<td align="center"></td>';
$q="select * from tanaman";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$arr_alternatif_id[]=$h['id_tanaman'];
		$arr_alternatif_str[]=$h['nama_tanaman'];
		$tb_header1.='<td align="center">'.$h['id_tanaman'].'</td>';
	}
}

$q="select * from kriteria";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$arr_kriteria_id[]=$h['id_kriteria'];
		$arr_kriteria_str[]=$h['nama_kriteria'];
		$tb_header.='<td align="center">'.$h['nama_kriteria'].'</td>';
	}
}

if(!empty($tb_header)){
	$tb_header='<tr bgcolor=#90EE90 style="color:#FFFFFF">'.$tb_header.'</tr>';
	$tb_header1='<tr>'.$tb_header1.'<td align="center">LF</td><td align="center">EF</td><td align="center">NF</td></tr>';
}else{
	$tb_header='<tr><td></td></tr>';
	$tb_header1='<tr><td></td></tr>';
}
for($i=0;$i<count($arr_alternatif_id);$i++){
	for($ii=0;$ii<count($arr_kriteria_id);$ii++){
		$q=mysql_query("select * from nilaikriteria where id_tanaman='".$arr_alternatif_id[$i]."' and id_kriteria='".$arr_kriteria_id[$ii]."'");
		if(mysql_num_rows($q)>0){
			$h=mysql_fetch_array($q);
			$n=round($h['bobot_normalisasi'],4);
		}else{
			$n=0;
		}
		$nilai[$arr_alternatif_id[$i]][]=$n;
	}
}

for($i=0;$i<count($arr_alternatif_id);$i++){
	$tmp='';
	for($ii=0;$ii<count($arr_kriteria_id);$ii++){
		$n=$nilai[$arr_alternatif_id[$i]][$ii];
		$tmp.='<td style="background:#FFFFFF" align="center" valign="top"><span style="background:#FFFFFF; border:none; " class="lnk">'.$n.'</span></a></td>';
	}
	$daftar.='
	<tr>
	<td width=180px valign="top">'.$arr_alternatif_str[$i].'</td>
	'.$tmp.'
	</tr>
	';
}

//PREFERENSI(1,2,true);
for($i=0;$i<count($arr_alternatif_id);$i++){
	$daftar_tmp='<td width=180px valign="top">'.$arr_alternatif_str[$i].'</td>';
	for($ii=0;$ii<count($arr_alternatif_id);$ii++){
		if($i<$ii){
			$daftar_tmp.='<td bgcolor=#FFFFFF align="center" valign="top">'.PREFERENSI($arr_alternatif_id[$i],$arr_alternatif_id[$ii],true).'</td>';
		}elseif($i>$ii){
			$daftar_tmp.='<td bgcolor=#FFFFFF align="center" valign="top">'.PREFERENSI($arr_alternatif_id[$ii],$arr_alternatif_id[$i],false).'</td>';
		}else{
			$daftar_tmp.='<td bgcolor=#E5E5E5 align="center" valign="top">0</td>';
		}
	}
	$daftar1.='<tr>'.$daftar_tmp.'<td style="font-weight:bold;" bgcolor=#E5E5E5 align="center">'.LF($arr_alternatif_id[$i]).'</td>
								  <td style="font-weight:bold;" bgcolor=#E5E5E5 align="center">'.EF($arr_alternatif_id[$i]).'</td>
								  <td style="font-weight:bold;" bgcolor=#E5E5E5 align="center">'.(LF($arr_alternatif_id[$i]) - EF($arr_alternatif_id[$i])).'</td>
								</tr>';
}

// Simpan Hasil Recomendasi ==========================================================================


$str->tb_header='<td align="center" width="120"></td>';
$max_1=0;
$max_2=0;
$max_3=0;
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
rsort($arr_lf);
rsort($arr_ef);
rsort($arr_nf);
$q="select * from tanaman";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$str->arr_alternatif_id[]=$h['id_tanaman'];
		$str->arr_alternatif_str[]=$h['nama_tanaman'];
		
		$lf=LF($h['id_tanaman']);
		$ef=EF($h['id_tanaman']);
		$nf=($lf-$ef);
		$rank_lf=0;$rank_ef=0;$rank_nf=0;
		for($i=0;$i<count($arr_lf);$i++){
			if($lf==$arr_lf[$i] and $rank_lf==0){$rank_lf=$i+1;}
			if($ef==$arr_ef[$i] and $rank_ef==0){$rank_ef=$i+1;}
			if($nf==$arr_nf[$i] and $rank_nf==0){$rank_nf=$i+1;}
		}
		$str->daftar_promethee.='
		  <tr>
			<td>'.$h['nama_tanaman'].'</td>
			<td align="center">'.$lf.'</td>
			<td align="center">'.$rank_lf.'</td>
			<td align="center">'.$ef.'</td>
			<td align="center">'.$rank_ef.'</td>
		  </tr>
		';

		if($max<$nf){
			$max=$nf;
			$alternatif=$h['nama_tanaman'];
			$id_3=$h['id_tanaman'];
		}
		$str->daftar_promethee1.='
		  <tr>
			<td>'.$h['nama_tanaman'].'</td>
			<td align="center">'.$nf.'</td>
			<td align="center">'.$rank_nf.'</td>
		  </tr>
		';
		
	}
}
if(empty($str->daftar_promethee)){
	$str->daftar_promethee='<tr><td colspan="4"></td></tr>';
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
		<div id="main_content">
        <div style="padding:10px 0 10px 0; font-size:12px;">
		<b>Hasil Perhitungan Nilai Preferensi Metode SAW :</b>
		<br>
		<table width="100%" border="1px" cellspacing="4" cellpadding="0" class="tabel_reg">
			<?php echo $tb_header;?>
			<?php echo $daftar;?>
		</table>
		<br />
		<b>Tabel Indeks Preferensi Metode Promethee :</b>
		<table width="100%" border="1px" cellspacing="4" cellpadding="0" class="tabel_reg">
			<?php echo $tb_header1;?>
			<?php echo $daftar1;?>
		</table>
		<br />
	
		
		<b>Kesimpulan :</b> <br />
		<?php echo 'Berdasarkan nilai Net Flow, <strong>'.$alternatif.'</strong> menjadi alternatif Tanaman Pertama dengan nilai '.$max;?>
		<br /><br />	
    	</div>
    	</div>
