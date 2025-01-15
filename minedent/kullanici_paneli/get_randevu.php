<?php
// agweg
include_once('../baglan.php');
// Doktor adını ve seçilen tarihi al
$doktor_id = $_GET['doktor_adi'];
$tarih = $_GET['tarih'];
// Doktorun müsait olduğu saatleri getir
$sorgu_saatler = mysqli_query($conn, "SELECT DISTINCT saat FROM randevu WHERE doktor_id = '$doktor_id' AND tarih = '$tarih'");

// Boş bir dizi oluştur
$saatler = array();

// Tüm saatleri diziye ekle
while ($satir_saatler = mysqli_fetch_array($sorgu_saatler)) {
    $saatler[] = $satir_saatler['saat'];
}
$randevu_saatleri = array();
for ($i = 9; $i < 18; $i++) {
    $saat = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00:00"; // Saati formatlamak için
    $randevu_saatleri[] = $saat;
}
$musait_saatler = array_diff($randevu_saatleri, $saatler);
// // JSON olarak çıktı üret
echo json_encode($musait_saatler);
?>
