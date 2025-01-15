<?php
@session_start();
if ( !isset($_SESSION["giris_yapan_uye"]) ) {
	echo yonlen('index.php'); 
} else {
  $oturum_sahibi =  $_SESSION["giris_yapan_uye"];
  $yetki_seviyesi = yetki_seviyesi($oturum_sahibi);
}
?>