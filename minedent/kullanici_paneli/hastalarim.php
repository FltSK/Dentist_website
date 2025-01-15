<!DOCTYPE html>
<html lang="tr">


<?php
$u = $_SESSION["giris_yapan_uye"];
include_once('editor_fonks.php');
if ($yetki_seviyesi != 2 && $yetki_seviyesi != 3) {
    yazdir_yetkisiz_islem();
    die;
}
	
?>
<head>
         <!-- Begin Page Content -->
<div class="container-fluid">
<?php
$u = $_SESSION["giris_yapan_uye"];
$sorgu_doktor_id=mysqli_query($conn,"SELECT id AS doktor_id FROM doktorlar WHERE user_id = $u");
$s=mysqli_fetch_array($sorgu_doktor_id);
if(empty($s)){
    yazdir_yetkisiz_islem_hasta();    
    die;
    }
$doktor_id = $s['doktor_id'];

$sorgu_randevu=mysqli_query($conn,"SELECT D.id AS randevu_id, D.tarih, D.saat, U.muayene_odasi, P.adi AS hasta_adi, P.soyadi AS hasta_soyadi FROM randevu AS D INNER JOIN doktorlar AS U ON U.id = D.doktor_id INNER JOIN uyeler AS P ON P.id = D.hasta_id WHERE D.doktor_id = $doktor_id");
$sorgu_rande=mysqli_query($conn,"SELECT D.id AS randevu_id, D.tarih, D.saat, U.muayene_odasi, P.adi AS hasta_adi, P.soyadi AS hasta_soyadi FROM randevu AS D INNER JOIN doktorlar AS U ON U.id = D.doktor_id INNER JOIN uyeler AS P ON P.id = D.hasta_id WHERE D.doktor_id = $doktor_id");


?>
                    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Hastalarım</h1>
</div>
<!-- Content Row -->
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> 
                <h6 class="m-0 font-weight-bold text-primary">Kayıtlı Hasta Sayısı</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                
                <!-- Tablo Başlangıcı -->
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" width="60%" id="dataTable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center' width="30%">Hasta Adı</th>
                                <th style='text-align:center' width="30%">Tarih</th>
                                <th style='text-align:center' width="20%">Saat</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                 while ( $satir_randevu = mysqli_fetch_array($sorgu_randevu)) {
                    ?>
				<tr>                                                                
				<td style="color:red; text-align:center; vertical-align: middle;"> <?php echo $satir_randevu['hasta_adi'] .' '. $satir_randevu['hasta_soyadi'] ?></td>
				<td style="color:blue; text-align:center; vertical-align: middle;"><?php echo $satir_randevu['tarih']; ?></td>
				<td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $satir_randevu['saat'] ?></td>
                </tr> 
                <?php
            }
                ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tablo Sonu -->
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Günlük Hastalarım</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- Tablo Başlangıcı -->
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" width="60%" id="dataTable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center' width="30%">Hasta Adı</th>
                                <th style='text-align:center' width="30%">Tarih</th>
                                <th style='text-align:center' width="20%">Saat</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                    $bugunun_tarihi = date("Y-m-d");
                   // $yarinin_tarihi = date("Y-m-d", strtotime($bugunun_tarihi . " +1 day"));
                 while ( $satir = mysqli_fetch_array($sorgu_rande)) {
                    if($bugunun_tarihi==$satir['tarih']){
                    ?>
				<tr>                                                                
                                <td style="color:red; text-align:center; vertical-align: middle;"> <?php echo $satir['hasta_adi'] .' '. $satir['hasta_soyadi'] ?></td>
                                <td style="color:blue; text-align:center; vertical-align: middle;"><?php echo $satir['tarih']; ?></td>
                                <td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $satir['saat'] ?></td>
                </tr> 
                <?php
                }
            }
                ?>
                            
                          
                        </tbody>
                    </table>
                </div>
                <!-- Tablo Sonu -->
            </div>
        </div>
    </div>
</div>

        </div>
            <!-- End of Main Content -->
</body>

</html>











