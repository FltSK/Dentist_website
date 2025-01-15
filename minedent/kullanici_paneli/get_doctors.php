<?php
// Veritabanı bağlantısı
@session_start();
include_once('../baglan.php');

$u = $_SESSION["giris_yapan_uye"];

// Uzmanlık alanını alma
$uzmanlik_alani = $_GET['uzmanlik_alani'];

// Veritabanından doktorları al


$sorgu_doktorlar = mysqli_query($conn,"select D.id as 'doktor_id',U.adi,U.soyadi,U.id as 'kullanici_id'from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id WHERE uzmanlık  ='$uzmanlik_alani'");
// Doktorları listele

if(mysqli_num_rows($sorgu_doktorlar) > 0) {
    while($sorgu_doktor = mysqli_fetch_assoc($sorgu_doktorlar)) {

            $doktor_id= $sorgu_doktor['doktor_id'];
            $doktor_isim = $sorgu_doktor['adi'] . ' ' . $sorgu_doktor['soyadi'];
        
            if($u==$sorgu_doktor['kullanici_id']){
             echo "<option value='' disabled selected>{$doktor_isim}</option>";
            }else{
             echo "<option value='{$doktor_id}'>{$doktor_isim}</option>";
            }
        
    }
} else {
    echo "<option value='' disabled selected >Doktor Bulunamadı</option>";
}
?>