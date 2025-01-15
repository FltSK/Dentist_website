<?php
$conn = mysqli_connect("localhost","root","","hastahane");
//$conn = mysqli_connect("localhost","121620181052","pOYfunvJdh4","db_121620181052");
 /* Bağlantı Kontrolü */
 if ( mysqli_connect_errno() ) {
	 echo "Bağlantı Başarısız. Hata :".mysqli_connect_error();
	 die();
 } else {
	// echo "Bağlantı Başarılı";
 }
 mysqli_query($conn,"SET NAMES 'utf8'");
 //mysqli_close($conn);
 ?>