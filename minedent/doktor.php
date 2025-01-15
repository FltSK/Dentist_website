<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
<?php
$doktor_bilgi = $_GET['id'];
$doktor_bilgi = substr($doktor_bilgi,3);
$doktor_id = substr($doktor_bilgi,0,-3);

	$sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id where U.id =$doktor_id");
	$satir_doktor = mysqli_fetch_array($sorgu_doktor);


?>
<html lang="<?php echo $dil ?>" dir="auto">
<div class="container-fluid py-5">
 <div class="container">
  <div class="row g-5">
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
            <div class="team-item">
                
                    <div class="team-item img" style="z-index: 1;">
                        <img class="img-fluid rounded-top w-100 fixed-size2" src="img/doktorlar/<?php echo  $satir_doktor['resim']?>" title="<?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?> "alt="<?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?>" style="max-width: 100%; max-height: 375px;">
                    </div>
                    <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                        <h4 class="mb-2"><?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?></h4>
                        <p class="text-primary mb-0"><?php echo  $satir_doktor['uzmanlık']   ?></p>
                    </div>
            </div>
        </div>
     <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
      <div class="section-title bg-light rounded h-100 p-5">
        <div class="client_container d-flex flex-column">
          <div class="client_text mt-4">
            <p align=justify>
              <?php echo html_entity_decode($satir_doktor['ozgecmis']) ?>
            </p>
			<hr style="width:100%;text-align:center;margin-left:0">
          </div>
        </div>
      </div>
    </div>
    </div>      
 </div>   
</div>    


