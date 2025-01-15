<?php
@session_start();

include_once('../baglan.php');
include_once('editor_fonks.php');
include_once('editor_fonks_mail.php');

$ip = $_SERVER['REMOTE_ADDR'];  
$islem = $_REQUEST['islem'];
date_default_timezone_set('Europe/Istanbul');

//echo $islem;
if ( $islem == 'giris_kontrol'  ){

	$kullanici = mysqli_real_escape_string($conn,@$_POST['kullanici']);
	$kod= mysqli_real_escape_string($conn,@$_POST['kod']);
	$sifre = mysqli_real_escape_string($conn,@$_POST['sifre']);
	$dkod= $_SESSION["dogrulamakodu"]; 


	if ( buyuk_harf($kod) != $dkod) {
			echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
			echo "<font color='red'>Doğrulama Kodu Yanlış</font></center>";
			die;
	}

	$sorgu = mysqli_query($conn,"Select * from uyeler where mail='$kullanici'");
	$say_uye = mysqli_num_rows($sorgu);

	if (  $say_uye > 0  ) {
		$satir = mysqli_fetch_array($sorgu);
		$d_sifre = $satir['sifre'];
	}

	if (  $say_uye == 0 ) {
			echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
			echo "<font color='red'>Kullanıcı adı yanlış</font></center>";	
	} elseif (  md5(sha1(sha1(sha1(md5($sifre))))) != $d_sifre  ) {
			echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
			echo "<font color='red'>Kullanıcı adı veya şifre yanlış</font></center>";
			echo "<center><a class=small href=sifremi_unuttum.php>Şifremi Unuttum?</a>";

	} else {
		$u = $satir['id'];
		$_SESSION["giris_yapan_uye"] = $u;
		mysqli_query($conn,"update uyeler set giris_sayisi=giris_sayisi + 1 where id='$u'");
		randevu_sil_oto();
		echo yonlen('editor_index.php'); 
	}

} 
elseif ( $islem == 'uye_ol_form'  ){

	$ad = buyuk_harf(mysqli_real_escape_string($conn,@$_POST['ad']));
	$soyad = buyuk_harf(mysqli_real_escape_string($conn,@$_POST['soyad']));
	$email = strtolower(mysqli_real_escape_string($conn,@$_POST['e-mail']));
	$tel = mysqli_real_escape_string($conn,@$_POST['tel']);
	$cinsiyet = @$_POST['cinsiyet'];
	$dtarih = mysqli_real_escape_string($conn,@$_POST['dtarih']);

	//$tarih = date("Y-m-d H:i:s");

	$md5yap=md5(rand(0,999999));
	$sifre = strtoupper(substr($md5yap, 8, 6));
	$db_sifre = md5(sha1(sha1(sha1(md5($sifre)))));

	$sorgu_kontrol = mysqli_query($conn,"select * from uyeler where mail='$email'");
	$say_kontrol = mysqli_num_rows($sorgu_kontrol);
	if ( $say_kontrol > 0  ) {
		echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
		echo "<font color='red'>Girilen mail adresi sistemde kayıtlıdır.<br>Şifremi unuttum bağlantısını kullanınız.</font></center>";
		die();
	}

	$sql = "Insert into uyeler (adi, soyadi, cinsiyet, sifre, uyelik_turu, mail, tel, dtarih, ip  ) 
			values 
			(	'$ad', 
				'$soyad', 
				'$cinsiyet',
				'$db_sifre',
				'2',
				'$email', 
				'$tel' ,
				'$dtarih', 
				'$ip'  )";	
	//	echo $sql;
	mysqli_query($conn,$sql);



			echo "<center><img src='admin_img/ok.png' width='24' height='24'> <br>";
			echo "<p style='color: blue;'>Üyelik İşleminiz Tamamlandı!!! <br> Şifre için mail adresinizi kontrol ederek giriş yapabilirsiniz. </p></center>";
			
			$icerik ="MineDent Kayıt İşleminiz Tamamlanmıştır. <p>
			MineDent üyelik bilgileriniz :  <p>
			<ul>
			<li>Ad : $ad </li>
			<li>Soyad : $soyad </li>
			<li>Telefon : $tel </li>		
			<li>E-mail : $email </li>
			<li>Şifre : $sifre </li>
			</ul>";
			
			// echo $icerik;
			
	//	mail_gonder($email,$icerik);
	mail_gonder('MineDent Üyelik Bilgileri',$icerik,array($email));
	
}
elseif ( $islem == 'sifre_hatirlatma'  ){

	$kullanici = mysqli_real_escape_string($conn,@$_POST['kullanici']);
	$kod= mysqli_real_escape_string($conn,@$_POST['kod']);
	$dkod= $_SESSION["dogrulamakodu"]; 


	$sorgu = mysqli_query($conn,"Select * from uyeler where mail='$kullanici'");
	$say_uye = mysqli_num_rows($sorgu);

	echo "<br>";

	if (  $say_uye > 0  ) {
		$satir = mysqli_fetch_array($sorgu);
		$kisi_id = $satir['id'];
		$kisi_ad = $satir['adi'];
		$kisi_soyad = $satir['soyadi'];
		$kisi_mail = $satir['mail'];
	} 

	if ( buyuk_harf($kod) != $dkod  ) {
		echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
		echo "Doğrulama kodu hatalı";
	} elseif (  $say_uye == 0  ) {
		echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
		echo "Böyle bir üye bulunamadı.";
	}
	else {
		
		$sorgu_genel = mysqli_query($conn,"select * from genel_bilgiler");
		$satir_genel = mysqli_fetch_array($sorgu_genel);

		$simdiki_zaman = date("Y-m-d H:i:s");
		$sql = "UPDATE uyeler SET sifre_istek = 1, sifre_istek_tarihi = '$simdiki_zaman' WHERE id='$kisi_id'";
		$sorgu = mysqli_query($conn, $sql);


		// Mail Bilgisi
		$mail_icerik = "<h1>Sayın $kisi_ad $kisi_soyad </h1> <br>"
					.date("d-m-Y H:i:s")." tarihinde şifre sıfırlama talebinde bulundunuz. <br>
					Şifrenizi sıfırlamak için aşağıda verilen linki kullanabilirsiniz. (<i>Link geçerlilik süresi 60 dakikadır</i>) <br>
					<a href='".$satir_genel['adres']."kullanici_paneli/yeni_sifre_olustur.php?id=".hash('sha256', rand(1,1000)).$kisi_id.hash('sha256', rand(1,1000))."'>Sıfırlama Linki </a>";
		// ***********************

			echo "<img src='admin_img/ok.png' width='24' height='24'><br>";
			echo "Şifre değiştirme maili adresinize gönderildi";
			
		mail_gonder('Şifre sıfırlama talebi',$mail_icerik,array($kisi_mail));

		}
}
elseif ( $islem == 'yeni_sifre'  ){

	$kullanici = mysqli_real_escape_string($conn,@$_POST['kullanici']);
	$sifre = mysqli_real_escape_string($conn,@$_POST['sifre']);
	$tsifre = mysqli_real_escape_string($conn,@$_POST['tsifre']);

	$sorgu = mysqli_query($conn,"Select * from uyeler where mail='$kullanici'");
	$say_uye = mysqli_num_rows($sorgu);

	echo "<br>";

	if (  $say_uye > 0  ) {
		$satir = mysqli_fetch_array($sorgu);
		$kisi_id = $satir['id'];
	} 

	if (  $say_uye == 0 ) {
		echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
		echo "Böyle bir üye bulunamadı.";
	} elseif (  $sifre != $tsifre ) {
		echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
		echo "Şifreler Eşleşmiyor.";
	} 
	else {
		
		// echo "şifre güncellenecek";
		
		$db_sifre = md5(sha1(sha1(sha1(md5($sifre)))));
		
		$sql = "UPDATE uyeler
					SET sifre ='$db_sifre', sifre_istek = 0, sifre_istek_tarihi = ''
				WHERE id='$kisi_id'";
	     //echo $sql;

		if (mysqli_query($conn,$sql)) {
			echo "<img src='admin_img/ok.png' width='24' height='24'><br>";
			echo "Şifreniz değiştirildi";
			echo yonlen_zamanli('index.php',2000); 
		}
		else{ echo "Beklenmeyen bir hata oluştu. Kod : 50";}

	}

}
elseif ( $islem == 'doktor_duzenleme' )  {     // doktor düzenleme

	$sifreli_id_bs64 = @$_REQUEST["doktor_id"];
	$sifreli_id = base64_decode($sifreli_id_bs64);
	$encryption_key = "sifreleme_123456";
	$doktor_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
	
	$doktor_id_sorgu =mysqli_query($conn,"select id from doktorlar where user_id=$doktor_id");
	$doktor_id_sorgu_satir=mysqli_fetch_array($doktor_id_sorgu);

	// echo($doktor_id_sorgu_satir['id']);

	$sorgu_doktor = mysqli_query($conn,"select * from doktorlar where id= {$doktor_id_sorgu_satir['id']}");
	$satir_doktor = mysqli_fetch_array($sorgu_doktor);
	$doktor_eski_resim = $satir_doktor['resim'];

	$doktor_adi = @$_REQUEST["doktor_adi"]; 
	$doktor_soyadi = @$_REQUEST["doktor_soyadi"]; 
	$doktor_ozgecmis = @$_REQUEST["doktor_ozgecmis"];
	$doktor_cinsiyeti = @$_REQUEST["doktor_cinsiyeti"];	
	$doktor_muayene_odasi =@$_REQUEST["doktor_muayene_odasi"];
	// echo $doktor_muayene_odasi;
	$doktor_ozgecmis= htmlentities($doktor_ozgecmis, ENT_QUOTES, "UTF-8");

	$sql2= "Update uyeler SET adi='$doktor_adi', soyadi='$doktor_soyadi', cinsiyet = '$doktor_cinsiyeti' where id={$satir_doktor['user_id']}";
    // echo($sql2);
	$sql = "Update doktorlar SET ozgecmis='$doktor_ozgecmis', muayene_odasi='$doktor_muayene_odasi' where id={$doktor_id_sorgu_satir['id']}";
	// echo($sql);
	if ( mysqli_query($conn,$sql) && mysqli_query($conn,$sql2) ) {
		
		echo "<img src='admin_img/save-icon.gif' width='24' title='Kayıt Edildi' alt='Kayıt Edildi' valign='middle'>";
	} else {
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}

	$isim = $_FILES['doktor_resim']['name'];
	$boyut = $_FILES['doktor_resim']['size'];
	$tmp = $_FILES['doktor_resim']['tmp_name'];

	//echo $isim;

	$yol = "../img/doktorlar/";
	$kabul_boyut = 800*800;
	$kabul_uzanti = array("gif","jpg","jpeg","png");

	if ( strlen($isim) > 0 ) {

	list($txt,$uzanti) = explode(".",$isim);
	if ( !in_array($uzanti,$kabul_uzanti) ) {
			echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
			die();	
	}

	if ( $boyut > $kabul_boyut ) {
			echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
			die();
	}

	$yeni_isim = $sifreli_id_bs64."_".time().".".$uzanti;

	//echo $yeni_isim;

	if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
	unlink($yol.$doktor_eski_resim);
	$sql = "Update doktorlar SET resim='$yeni_isim' where id={$doktor_id_sorgu_satir['id']}";
	if ( mysqli_query($conn,$sql) ) {
		echo "<img src='admin_img/pr_img.png' width='24' title='Resim Değiştirildi' alt='Resim Değiştirildi' valign='middle'>";
	} else {
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}
	} else {			
		echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
		die();
	}
	}
}
elseif ( $islem == 'doktor_ekleme' )  {     // doktor ekleme
     
		$doktor_adi = @$_REQUEST["doktor_adi"];
		$doktor_email = @$_REQUEST["doktor_email"]; 
		$sorgu_kontrol = mysqli_query($conn,"select * from uyeler where mail='$doktor_email'");
		$say_kontrol = mysqli_num_rows($sorgu_kontrol);
	if ( $say_kontrol > 0  ) {
		echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
		echo "<font color='red'>Girilen mail adresi sistemde kayıtlıdır.<br>Şifremi unuttum bağlantısını kullanınız.</font></center>";
		die();
	}
		$doktor_soyadi = @$_REQUEST["doktor_soyadi"]; 
		$doktor_cinsiyeti = @$_REQUEST["doktor_cinsiyeti"];
		$doktor_ozgecmis = @$_REQUEST["doktor_ozgecmis"]; 
		$doktor_ozgecmis= htmlentities($doktor_ozgecmis, ENT_QUOTES, "UTF-8");
		$doktor_uzmanlik =@$_REQUEST['doktor_uzmanlik'];
		$doktor_muayene_odasi =@$_REQUEST['doktor_muayene_odasi'];

		$md5yap=md5(rand(0,999999));
		$sifre = strtoupper(substr($md5yap, 8, 6));
		$db_sifre = md5(sha1(sha1(sha1(md5($sifre)))));
		

		$isim = $_FILES['doktor_resim']['name'];
		$boyut = $_FILES['doktor_resim']['size'];
		$tmp = $_FILES['doktor_resim']['tmp_name'];
		
		//echo $isim;

		$yol = "../img/doktorlar/";
		$kabul_boyut = 800*800;
		$kabul_uzanti = array("gif","jpg","jpeg","png");

		if ( !strlen($isim) > 0 ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
					die();
		}

		list($txt,$uzanti) = explode(".",$isim);
		if ( !in_array($uzanti,$kabul_uzanti) ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
					die();	
		}

		if ( $boyut > $kabul_boyut ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
					die();
		}

		$yeni_isim = time().rand(100,999).".".$uzanti;

		//echo $yeni_isim;

		if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
			// $sql = "Insert into doktorlar (adi, soyadi, ozgecmis, cins, resim,uzmanlık,muayene_odasi) values ('$doktor_adi','$doktor_soyadi','$doktor_ozgecmis','$doktor_cinsiyeti','$yeni_isim','$doktor_uzmanlik','$doktor_muayene_odasi')";
			$sql = "Insert into uyeler (adi, soyadi, cinsiyet, uyelik_turu,mail,sifre) values ('$doktor_adi','$doktor_soyadi','$doktor_cinsiyeti', 3,'$doktor_email','$db_sifre')";
			
			if ( mysqli_query($conn,$sql) ) {
				$SqlGetUserId = mysqli_query($conn,"Select Id from uyeler where id = (Select MAX(Id) from uyeler) and adi='$doktor_adi' and soyadi='$doktor_soyadi'"); // En son eklenen kullanıcın id sini alıp detay bilgilerini girilecektir.
				$sqlgetuserId_f= mysqli_fetch_array($SqlGetUserId);
				$user_id= $sqlgetuserId_f['Id'];
				$sql2 = "Insert into doktorlar (ozgecmis, resim,uzmanlık,muayene_odasi, user_id) values ('$doktor_ozgecmis','$yeni_isim','$doktor_uzmanlik','$doktor_muayene_odasi', $user_id)";
				 if ( mysqli_query($conn,$sql2) ){	
					
					$icerik ="MineDent Kayıt İşleminiz Tamamlanmıştır.Lütfen ilk girişinizde şifrenizi değiştiriniz. <p>
					MineDent üyelik bilgileriniz :  <p>
					<ul>
					<li>Ad : $doktor_adi </li>
					<li>Soyad : $doktor_soyadi </li>		
					<li>E-mail : $doktor_email </li>
					<li>Şifre : $sifre </li>
					</ul>";
					
					// echo $icerik;
					
			//	mail_gonder($email,$icerik);
			      mail_gonder('MineDent Üyelik Bilgileri',$icerik,array($doktor_email));
				  echo yonlen('editor_index.php?istek=doktorlar&doktor_basharf=tum');
				 // echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
				 }
			} else {
				echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
			}
		} else {			
				echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
				die();
		}
	
}
elseif ( $islem == 'doktor_silme' )  {     // doktor silme



	$sifreli_id_bs64 = @$_REQUEST["doktor_id"];; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	$encryption_key = "sifreleme_123456";
	$doktor_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key); 

	$sorgu_doktor = mysqli_query($conn,"select * from doktorlar where user_id='$doktor_id'");
	$satir_doktor = mysqli_fetch_array($sorgu_doktor);
	$doktor_resim = $satir_doktor['resim'];
	$yol = "../img/doktorlar/";
	unlink($yol.$doktor_resim);
	mysqli_query($conn,"delete from doktorlar where user_id='$doktor_id'");
	mysqli_query($conn,"delete from uyeler where id='$doktor_id'");
	echo yonlen('editor_index.php?istek=doktorlar&doktor_basharf=tum');


}
elseif ( $islem == 'hizmet_silme' )  {   

	
	
		$sifreli_id_bs64 = @$_REQUEST["hizmet_id"];; 
		$sifreli_id = base64_decode($sifreli_id_bs64);
		$encryption_key = "sifreleme_123456";
		$hizmet_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key); 
	
		$sorgu_hizmet = mysqli_query($conn,"select * from hizmetler where id='$hizmet_id'");
		$satir_hizmet = mysqli_fetch_array($sorgu_hizmet);
		$hizmet_resim = $satir_hizmet['resim'];
		$yol = "../img/hizmet/";
		unlink($yol.$hizmet_resim);
		mysqli_query($conn,"delete from hizmetler where id='$hizmet_id'");
		
		echo yonlen('editor_index.php?istek=fiyat_duzenleme');
	
	
}
elseif ( $islem == 'fiyat_duzenleme' )  {     

		$sifreli_id_bs64 = @$_REQUEST["hizmet_id"];; 
		$sifreli_id = base64_decode($sifreli_id_bs64);
		$encryption_key = "sifreleme_123456";
		$hizmet_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
		
	
	
		$sorgu_hizmet = mysqli_query($conn,"select * from hizmetler where id='$hizmet_id'");
		$satir_hizmet = mysqli_fetch_array($sorgu_hizmet);
		$hizmet_eski_resim = $satir_hizmet['resim'];
		$hizmet_adi = @$_REQUEST["hizmet_adi"]; 
		$hizmet_fiyati = @$_REQUEST["hizmet_fiyat"]; 
		
	
	$sql = "Update hizmetler SET hizmet='$hizmet_adi', fiyat='$hizmet_fiyati' where id='$hizmet_id'";
		if ( mysqli_query($conn,$sql) ) {
			echo "<img src='admin_img/save-icon.gif' width='24' title='Kayıt Edildi' alt='Kayıt Edildi' valign='middle'>";
		} else {
			echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
		}
	
		$isim = $_FILES['hizmet_resim']['name'];
		$boyut = $_FILES['hizmet_resim']['size'];
		$tmp = $_FILES['hizmet_resim']['tmp_name'];
	
	//echo $isim;
	
	$yol = "../img/hizmet/";
	$kabul_boyut = 800*800;
	$kabul_uzanti = array("gif","jpg","jpeg","png");
	
	if ( strlen($isim) > 0 ) {
	
		list($txt,$uzanti) = explode(".",$isim);
		if ( !in_array($uzanti,$kabul_uzanti) ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
				die();	
		}
	
		if ( $boyut > $kabul_boyut ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
				die();
		}
	
		$yeni_isim = $sifreli_id_bs64."_".time().".".$uzanti;
	
	//echo $yeni_isim;
	
		if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
		unlink($yol.$hizmet_eski_resim);
		$sql = "Update hizmetler SET resim='$yeni_isim' where id='$hizmet_id'";
		if ( mysqli_query($conn,$sql) ) {
			echo "<img src='admin_img/pr_img.png' width='24' title='Resim Değiştirildi' alt='Resim Değiştirildi' valign='middle'>";
		} else {
			echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
		}
		} else {			
			echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
			die();
		}
	}
		
}
elseif ( $islem == 'hizmet_ekleme' )  {  
     
	$hizmet_adi = @$_REQUEST["hizmet_adi"]; 
	$hizmet_fiyati = @$_REQUEST["hizmet_fiyat"]; 
	

	$isim = $_FILES['hizmet_resim']['name'];
	$boyut = $_FILES['hizmet_resim']['size'];
	$tmp = $_FILES['hizmet_resim']['tmp_name'];
	
	//echo $isim;

	$yol = "../img/hizmet/";
	$kabul_boyut = 800*800;
	$kabul_uzanti = array("gif","jpg","jpeg","png");

	if ( !strlen($isim) > 0 ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
				die();
	}

	list($txt,$uzanti) = explode(".",$isim);
	if ( !in_array($uzanti,$kabul_uzanti) ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
				die();	
	}

	if ( $boyut > $kabul_boyut ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
				die();
	}

	$yeni_isim = time().rand(100,999).".".$uzanti;



	if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
		$sql = "Insert into hizmetler (hizmet,fiyat,resim) values ('$hizmet_adi','$hizmet_fiyati','$yeni_isim')";
		if ( mysqli_query($conn,$sql) ) {
			echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
			echo yonlen('editor_index.php?istek=fiyat_duzenleme');
			
		} else {
			echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
		}
	} else {			
			echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
			die();
	}

}
elseif ( $islem == 'randevu_alma' ) {
	$doktor_id = @$_REQUEST["doktor_adi"];
	$u = $_SESSION["giris_yapan_uye"];
	$r_tarih = @$_REQUEST["randevu_tarihi"];
	$r_saat = @$_REQUEST["randevu_saati"];

	$sql = "SELECT COUNT(*) as randevu_sayisi FROM randevu WHERE hasta_id = '$u'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $randevu_sayisi = $row['randevu_sayisi'];
    mysqli_free_result($result);

	//echo "Randevu Sayısı: " . $randevu_sayisi; // Değeri kontrol etmek için
	if ($randevu_sayisi > 0) {
		// Kodun içine girildiğini doğrulamak için		
		echo"<img src='admin_img/gecersiz.png' width='24' title='Her hasta günde 1 kez randevu alabilir.Zaten randevunuz var.Randevularım kısmını kontrol edin.' alt='Her hasta günde 1 kez randevu alabilir.Zaten randevunuz var.Randevularım kısmını kontrol edin.'  valign='middle'>";


	} else {
	
    // Randevu ekleme sorgusu
	if($doktor_id==null){
		echo("Kendininze Randevu Alamazsınız");
	}else{
		$sql = "INSERT INTO randevu (doktor_id, tarih, saat, hasta_id) VALUES ('$doktor_id', '$r_tarih', '$r_saat', '$u')";
		if (mysqli_query($conn, $sql)) {
			echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
			echo "Kayıt başarılı";
			echo yonlen('editor_index.php?istek=randevu_al');
		} else {
			echo "Hata: " . mysqli_error($conn);
		}}
	}
		
	
	


}
elseif ( $islem == 'randevu_silme' )  {     // doktor silme


    
	$sifreli_id_bs64 = @$_REQUEST["randevu_id"];; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	$encryption_key = "sifreleme_123456";
	$randevu_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key); 

	mysqli_query($conn,"delete from randevu where id='$randevu_id'");
	echo yonlen('editor_index.php?istek=randevularım');


}
elseif ( $islem == 'randevu_silme_mail' )  {     // doktor silme



	$sifreli_id_bs64 = @$_REQUEST["randevu_id"];; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	$encryption_key = "sifreleme_123456";
	$randevu_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key); 
	$m=mysqli_query($conn,"SELECT mail FROM randevu AS D INNER JOIN doktorlar AS U ON U.id = D.doktor_id INNER JOIN uyeler AS P ON P.id = D.hasta_id");
	$a=mysqli_query($conn,"select * from randevu as R INNER JOIN doktorlar as D on R.doktor_id=D.id INNER JOIN uyeler as U on U.id=D.user_id where R.id= $randevu_id");
	$b=mysqli_fetch_array($a);
	$c=mysqli_fetch_array($m);
	echo $c['mail'];
	mysqli_query($conn,"delete from randevu where id='$randevu_id'");


	//	echo $sql;
	$email = $c['mail'];
	$icerik = "Randevunuz MineDent tarafından doktorumuzun veya kliniğimizin çalışma saati düzenlemesi nedeniyle iptal edilmiştir.<p>
			RANDEVU BİLGİLERİNİZ:  <p>
			<ul>
			<li>Doktor Ad : " . $b['adi'] . " </li>
			<li>Doktor Soyad : " . $b['soyadi'] . " </li>
			<li>Tarih : " . $b['tarih'] . " </li>
			<li>Saat: " . $b['saat'] . " </li>
			<li>Muayene odası : " . $b['muayene_odasi'] . " </li>
			</ul>";

	// Değişkenler doğru kullanılıyor mu kontrol edin
	if ($email && $icerik) {
		mail_gonder('MineDent Randevu Bilgilendirme', $icerik, array($email));
		echo yonlen('editor_index.php?istek=randevu_yonet');
	}
	else {
		echo "E-posta veya içerik hatalı!";
	}


}		
else{
	echo "Beklenmeyen bir hata oluştu. Kod : 10";
}

?>

