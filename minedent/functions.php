<?php
$jsonTR = @file_get_contents('languages/lang_tr.json');
$jsonEN = @file_get_contents('languages/lang_en.json');
$jsonDE = @file_get_contents('languages/lang_de.json');
$jsonAR = @file_get_contents('languages/lang_ar.json');
$jsonFR = @file_get_contents('languages/lang_fr.json');
function ml_return($dil,$metin){
	global $jsonTR;
	global $jsonEN;
	global $jsonDE;
	global $jsonAR;
	global $jsonFR;
	if ( $dil == "tr" ) {
		$metinler = json_decode($jsonTR, true);	
	}
	elseif ( $dil == "en"  ) {
		$metinler = json_decode($jsonEN, true);
	}
	elseif ( $dil == "de"  ) {
		$metinler = json_decode($jsonDE, true);
	}
	elseif ( $dil == "ar"  ) {
		$metinler = json_decode($jsonAR, true);
	}
	elseif ( $dil == "fr"  ) {
		$metinler = json_decode($jsonFR, true);
	}
	else {
		$metinler = json_decode($jsonEN, true);
	}
	
		if ( is_array($metin) ) {
			$dizi = $metin;
			//print_r($dizi);
			$ilkAnahtar = array_keys($dizi)[0];
			$d_n = count($dizi);			
			if (array_key_exists($ilkAnahtar, $metinler)) {
			//	echo $metinler[$ilkAnahtar];
				if ( $d_n == 2  ) {
					$d1 = $dizi['d1'];
					$sonuc_metin = str_replace("{deger1}", $d1, $metinler[$ilkAnahtar]);
				} elseif ( $d_n == 3 ) {
					$d1 = $dizi['d1'];   
					$d2 = $dizi['d2'];
					$sonuc_metin = str_replace(array("{deger1}","{deger2}"), array($d1,$d2), $metinler[$ilkAnahtar]);
				}
			} else {
				$sonuc_metin = "no translation yet";				
			}				
		} else {
			if (array_key_exists($metin, $metinler)) {
			       $sonuc_metin = $metinler[$metin];
			} else {
				if ( is_numeric($metin)) {
					$sonuc_metin = $metin;
				}
				else {
					$sonuc_metin = "!!!".$metin;
				}
			}
		} 
	return $sonuc_metin;
}
function ml_yaz($dil,$metin){
	$ml_metin = ml_return($dil,$metin);
	echo $ml_metin;
}


function url_baslik ($baslik)
{ 
 //değiştirelecek türkçe karakterler
 $TR=array('ç','Ç','ı','İ','ş','Ş','ğ','Ğ','ö','Ö','ü','Ü');
 $EN=array('c','c','i','i','s','s','g','g','o','o','u','u');
 //türkçe karakterleri değiştirir
 $baslik= str_replace($TR,$EN,$baslik);
 //tüm karakterleri küçültür
 $baslik=mb_strtolower($baslik,'UTF-8');
 // a'dan z'ye olan harfler, 0'dan 9 a kadar sayılar, tire (-), boşluk ve alt çizgi (_)
 // dışındaki tüm karakteri siler
 $baslik=preg_replace('#[^-a-zA-Z0-9_ ]#','',$baslik);
 //cümle aralarındaki fazla boşluğu kaldırır
 $baslik=trim($baslik);
 //cümle aralarındaki boşluğun yerine tire (-) koyar
 $baslik=preg_replace('#[-_ ]+#','-',$baslik);
 return $baslik;
}

function doktor_url ($id, $baslik) {  
   $t_id = rand(100,999).$id.rand(100,999);
   return sprintf('doktor/%s/%s',url_baslik($baslik),$t_id);
}
?>