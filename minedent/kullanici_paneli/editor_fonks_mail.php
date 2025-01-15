<?php
// https://github.com/PHPMailer/PHPMailer
// Sınıf Ekleme Özellikleri
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'admin_vendor/PHPMailer/src/Exception.php';
require 'admin_vendor/PHPMailer/src/PHPMailer.php';
require 'admin_vendor/PHPMailer/src/SMTP.php';

// https://support.google.com/accounts/answer/185833?hl=tr
// gmail de kullanabilmek için ön ayarlar

// Mail Gönderici Bilgileri

 $mail_adres 			= 'serhun.krd@gmail.com';
 $mail_kullanici 		= 'serhun.krd@gmail.com';
 $mail_sifre 			= 'znrjopcpyxwvvcyw';   // GMail 2 Adımlı Doğrulama Aktif Edilip - Uygulama Şifresi Eklenmeli 
 $mail_host 			= 'smtp.gmail.com';
 $mail_secure 			= 'ssl';
 $mail_port 			= 465;  
 $mail_gonderici_adi 	= 'MineDent';  
 $mail_webmaster	 	= 'srhnkrdnz@gmail.com'; 
// ***********************

include('../baglan.php');
function mail_gonder($mail_konu,$mail_icerik,$mail_alicilar){
	global $mail_kullanici;
	global $mail_sifre;
	global $mail_adres;
	global $mail_gonderici_adi;
	global $mail_port;
	global $mail_host;
	global $mail_secure;
	global $mail_webmaster;
	global $conn;

if ( is_numeric($mail_alicilar) ) {
	$alicilar = array();
	
	if ( $mail_alicilar == 0  ) {      // 0 : Yalnızca webmaster a gönderilen mail
			$alicilar[] = $mail_webmaster;
	}
	elseif ( $mail_alicilar == 1  ) {  // 1 : Yalnızca editörlere gönderilen mail
			$sorgu_mail = mysqli_query($conn,"select * from uyeler where uyelik_turu = 1");
			while ( $satir_mail = mysqli_fetch_array($sorgu_mail)) {
				$alicilar[] = $satir_mail['mail'];
			}
	}
	elseif ( $mail_alicilar == 2  ) {  // 2 : Tüm üyelere gönderilen mail 
			$sorgu_mail = mysqli_query($conn,"select * from uyeler where mail <> ''");
			while ( $satir_mail = mysqli_fetch_array($sorgu_mail)) {
				$alicilar[] = $satir_mail['mail'];
			}
	}
	$mail_alicilar = $alicilar;
}


$mail = new PHPMailer(true);
try {
 //Server settings
 $mail->CharSet = 'UTF-8';
 $mail->SMTPDebug = 0; // debug on - off
 $mail->isSMTP(); 
 $mail->Host = $mail_host;  // 'smtp.ogu.edu.tr'; 'smtp.gmail.com'; // SMTP sunucusu örnek : mail.alanadi.com
 $mail->SMTPAuth = true; // SMTP Doğrulama // gmail için true olmalı
 $mail->Username = $mail_kullanici; // Mail kullanıcı adı
 $mail->Password = $mail_sifre; // Mail şifresi veya Uygulama Şifresi
 $mail->SMTPSecure = $mail_secure; // 'starttls'; 'tls'; 'ssl' // Şifreleme
 $mail->Port = $mail_port; // 25, 465, 587; // SMTP Port
 $mail->SMTPOptions = array(
 'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
 );

 // Gönderici Bilgisi
 $mail->setfrom($mail_adres, $mail_gonderici_adi);
 
 // $mail->addAddress('asd@hotmail.com');   // alıcı tek kişi ise kullanılabilir
 // alıcı listesi
 foreach($mail_alicilar as $key => $val)
{
   $mail->AddBCC($val);
}
 // Yanıt Adresi
 $mail->addReplyTo($mail_adres, $mail_gonderici_adi);
 //İçerik
 $mail->isHTML(true);
 $mail->Subject = $mail_konu;
 $mail->Body = $mail_icerik;

 $mail->send();
	// echo "Mesajınız gönderildi";
 return true;
} catch (Exception $e) {
	// echo 'Mesajınız gönderilemedi. Hata: ', $mail->ErrorInfo;
 return false;
}
}

// Kullanım Örnekleri
// mail_gonder('Konu','İçerik',0);
// mail_gonder('Konu2','İçerik2',array('serhun.krd@gmail.com','odabasalper@gmail.com'));
 ?>