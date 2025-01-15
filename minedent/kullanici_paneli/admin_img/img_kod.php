<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

putenv('GDFONTPATH=' . realpath('.'));
/* Olusturulan kodu diger sayfalara tasiyabilmemiz icin oturum baslatiyoruz.
0-999 araliginda bir sayi olusturup bunu md5 ile sifreliyoruz.
*/
//$md5yap=md5(rand(0,9999));

//md5 ile sifrelenen sayimizin uzunlugu 32 karakter olacaktir. Biz 6 karakterli alacagiz.
//$dogrulamakodu = strtoupper(substr($md5yap, 8, 6));
//$dogrulamakodu = strtoupper(substr($md5yap, 8, 5));
$dogrulamakodu = rand(101, 999);

//Dogrulama icin kullanicak kodumuzu acilan oturuma kaydediyoruz.
$_SESSION["dogrulamakodu"] = $dogrulamakodu;

//echo $_SESSION["dogrulamakodu"];

//Resim boyutlari belirleniyor
$en = 300;
$boy = 100;

//Uzerinde calisacagimiz resim olusturuluyor.
$image = ImageCreate($en, $boy);

//Beyaz,Siyah ve Kirmizi renkler olusturuyoruz. Rakamlar renkleri ifade etmektedir.
$beyaz = ImageColorAllocate($image, 255, 255, 255);
$siyah = ImageColorAllocate($image, 0, 0, 0);
$kirmizi = ImageColorAllocate($image, 242, 0, 0);

// Yaz??ntu belirliyoruz
//$font = "Font1.ttf";
//$font="./font1.ttf";
$font="./Ningst.otf";


//Arka plani beyaz yapiyoruz
ImageFill($image, 0, 0, $beyaz);

//Olusturulan dogrulama kodunu resime yaziyoruz.
ImageTtftext($image, 80, 0, 25, 90, $siyah, $font, $_SESSION["dogrulamakodu"]);

//Gorunumu biraz karistirmak icin cizgilerle gorunumu zorlastiriyoruz.
//Dilerseniz imageline() satirlarini kaldirarak cizgileri yok edebilirsiniz.
imageline($image, 0, 2, $en, 2, $kirmizi);
imageline($image, 0, 125, $boy, 0, $kirmizi);
imageline($image, $en, $boy, 40, 0, $kirmizi);
imageline($image, 0, 23, $en, 23, $kirmizi);

header("Content-Type: image/png");

//Resmimizi Jpg formatinda basiyoruz.
ImagePng($image);

//Bir kereye mahsus kullanacagimiz icin siliyoruz.
ImageDestroy($image);
exit();

?>