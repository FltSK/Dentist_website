<?php
include_once('editor_fonks.php');
include_once('editor_fonks_mail.php');
	
?>

<div class="container-fluid">
<!-- Page Heading -->
<?php
$u = $_SESSION["giris_yapan_uye"];
$sorgu_doktor_id=mysqli_query($conn,"SELECT id AS doktor_id FROM doktorlar");
$s=mysqli_fetch_array($sorgu_doktor_id);
$doktor_id = $s['doktor_id'];
$sorgu_rand=mysqli_query($conn,"SELECT D.id AS randevu_id, D.tarih, D.saat, U.muayene_odasi, P.adi AS hasta_adi, P.soyadi AS hasta_soyadi FROM randevu AS D INNER JOIN doktorlar AS U ON U.id = D.doktor_id INNER JOIN uyeler AS P ON P.id = D.hasta_id");	
$sorgu_randevu=mysqli_query($conn,"select D.id as randevu_id,D.tarih,D.saat,U.muayene_odasi,P.adi,P.soyadi from randevu as D INNER JOIN doktorlar as U on U.id = D.doktor_id INNER JOIN uyeler as P on P.id = U.user_id ");




?>
<h1 class="h3 mb-4 text-gray-800">Randevular</h1>					
    <div class="card-body">
    <div class="table-responsive">
			<table class="table table-bordered" width='60%' id="dataTable" cellpadding="0" cellspacing="0">
			<thead>
			  <tr>	
				<th style='text-align:center' width="30%">Doktor</th>
                <th style='text-align:center' width="30%">Hasta Adı</th>
				<th style='text-align:center' width="30%">Tarih</th>
				<th style='text-align:center' width="20%">Saat</th>
				<th style='text-align:center' width="20%">Muayene Yeri</th>
                <th style='text-align:center' width="20%"></th>
			  </tr>
			<thead>
			<tbody>
                <?php
            while ( $satir_randevu = mysqli_fetch_array($sorgu_randevu)) {
                 $y_id = $satir_randevu['randevu_id'];

                $encryption_key = "sifreleme_123456";
				$sifreli_id = openssl_encrypt($y_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				$sifreli_id = base64_encode($sifreli_id);
                while($satir_rand = mysqli_fetch_array($sorgu_rand)){
                ?>
				<tr>                                                                
				<td style="color:red; text-align:center; vertical-align: middle;"> <?php echo $satir_randevu['adi'] .' '. $satir_randevu['soyadi'] ?></td>
				<td style="color:red; text-align:center; vertical-align: middle;"> <?php echo $satir_rand['hasta_adi'] .' '. $satir_rand['hasta_soyadi'] ?></td>
                <td style="color:blue; text-align:center; vertical-align: middle;"><?php echo $satir_randevu['tarih']; ?></td>
				<td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $satir_randevu['saat'] ?></td>
				<td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $satir_randevu['muayene_odasi'] ?></td>
                <td style="font-weight:bold; text-align:center; vertical-align: middle;">
                <button class="btn btn-primary" onclick="return confirm('Randevuyu silmek istediğinizden emin misiniz?') && handleButtonClick('<?php echo $sifreli_id; ?>')">Sil</button>
            </td>
                
                </tr>
				<?php
                }
            }
                ?>
			</tbody>			
			</table>
		</div>
		</div>
        <script>
function handleButtonClick(id) {

    window.location.href = 'isle.php?islem=randevu_silme_mail&randevu_id=' + id;
}
</script>