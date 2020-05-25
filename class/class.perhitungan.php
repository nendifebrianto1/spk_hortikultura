<?php
error_reporting(0);
class Perhitungan {
public function hasilperhitungan() {
	function PREFERENSI($id_alternatif1, $id_alternatif2, $ab){
	if($id_alternatif1==$id_alternatif2){
		return 0;
	}
	else {
		$n=0;
		$q=mysql_query("select * from kriteria");
		if(mysql_num_rows($q)>0) {
			$n=mysql_num_rows($q);
		while($h=mysql_fetch_array($q)) {
				$k[]=$h['id_kriteria'];
				$minmax[]=$h['minmax'];
				$t[]=$h['tipe_preferensi'];
			}
		}

		for($i=0;$i<$n;$i++){
			$q=mysql_query("select bobot_normalisasi from nilaikriteria where id_tanaman='".$id_alternatif1."' and id_kriteria='".$k[$i]."'");
			if(mysql_num_rows($q)>0) {
				$h=mysql_fetch_array($q);
				$a1=$h['bobot_normalisasi'];
			}
			else {
				$a1=0;
			}
			
			$q=mysql_query("select bobot_normalisasi from nilaikriteria where id_tanaman='".$id_alternatif2."' and id_kriteria='".$k[$i]."'");
			if(mysql_num_rows($q)>0){
				$h=mysql_fetch_array($q);
				$a2=$h['bobot_normalisasi'];
			}
			else {
				$a2=0;
			}
			
			$cal=true;
			if($minmax[$i]=='max') {
				if($a1 <= $a2) {
					$pref1=0;
					$cal=true;
				}
				else {
					$pref1=1;
					$pref2=0;
					$cal=false;
				}
			}
			else {
				if($a1 > $a2){
					$pref1=0;
					$cal=true;
				}
				else {
					$pref1=1;
					$pref2=0;
					$cal=false;
				}
			}
			if($cal==true){
				$d=$a1 - $a2;
				switch($t[$i]){
				case 1:
					if($d==0){$pref2=0;}else{$pref2=1;}
					break;
				}
			}
			$tot_pref1=$tot_pref1 + $pref1;
			$tot_pref2=$tot_pref2 + $pref2;
		}
	}
	
	if($ab==true) {
		return round($tot_pref1/$n,3);
	}
	else {
		return round($tot_pref2/$n,4);
	}
}

	function LF($id_alternatif) {
		$q="select * from tanaman";
		$q=mysql_query($q);
		if(mysql_num_rows($q) > 0) {
			$j=mysql_num_rows($q);
			while($h=mysql_fetch_array($q)){
				$arr_alternatif_id[]=$h['id_tanaman'];
			}
		}
	
	for($i=0;$i<count($arr_alternatif_id);$i++) {
		if($arr_alternatif_id[$i]==$id_alternatif) {
			for($ii=0;$ii<count($arr_alternatif_id);$ii++) {
				if($i<$ii) {
					$n=PREFERENSI($arr_alternatif_id[$i],$arr_alternatif_id[$ii],true);
				}
				elseif($i>$ii) {
					$n=PREFERENSI($arr_alternatif_id[$ii],$arr_alternatif_id[$i],false);
				}
				else {
					$n=0;
				}
				$tot_n=$tot_n + $n;
			}
		}
	}
	return round($tot_n/($j-1),3);
}

	function EF($id_alternatif) {
		$q="select * from tanaman";
		$q=mysql_query($q);
		if(mysql_num_rows($q) > 0) {
			$j=mysql_num_rows($q);
			while($h=mysql_fetch_array($q)) {
				$arr_alternatif_id[]=$h['id_tanaman'];
			}
		}
	
	for($i=0;$i<count($arr_alternatif_id);$i++) {
			for($ii=0;$ii<count($arr_alternatif_id);$ii++) {  
				if($arr_alternatif_id[$ii]==$id_alternatif) {
				if($i<$ii){
					$n=PREFERENSI($arr_alternatif_id[$i],$arr_alternatif_id[$ii],true);
				}
				elseif($i>$ii) {
					$n=PREFERENSI($arr_alternatif_id[$ii],$arr_alternatif_id[$i],false);
				}
				else {
					$n=0;
				}
				$tot_n=$tot_n + $n;
				}
			}
	}
	return round($tot_n/($j-1),3);
	}
}
}
?>
