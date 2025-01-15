<!DOCTYPE html>
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn"><?php ml_yaz($dil,"Diş Hekimlerimiz")?></h1>
                <a href="" class="h4 text-white"><?php ml_yaz($dil,"Ana Sayfa")?></a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h4 text-white"><?php ml_yaz($dil,"Diş Hekimlerimiz")?></a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title bg-light rounded h-100 p-5">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?php ml_yaz($dil,"Diş Hekimlerimiz")?></h5>
                        <br>
                        <br>
                        <h1 class="display-6 mb-4"><?php ml_yaz($dil,"Sertifikalı ve deneyimli diş hekimlerimizle tanışın")?></h1>
                        <br>
                        <br>
                        <div style="display: flex; justify-content: space-around;">
                            <a href="randevu?lang=<?php echo $dil?>" class="btn btn-primary py-3 px-3"><?php ml_yaz($dil,"Randevu")?></span></a>
                            <div style="margin-left: 10px;"></div>
                            <a href="tum_doktorlar" class="btn btn-secondary py-3 px-3"><?php ml_yaz($dil,"Tüm Doktorlar")?></a>
                        </div>
                    </div>
                </div>

    <?php
	  $sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id order by rand() limit 5 ");
	  $say_doktor = mysqli_num_rows($sorgu_doktor);
	  
		if ( $say_doktor > 0 ) {
		  
			while ( $satir_doktor = mysqli_fetch_array($sorgu_doktor) ) {
                $link= doktor_url( $satir_doktor['id'],$satir_doktor['adi'].' '.$satir_doktor['soyadi']);
                
    ?>
        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="team-item">
                <!-- <a href='?sayfa=doktor&id=<?php echo hash('sha256',rand(1,1000)).$satir_doktor['id'].hash('sha256',rand(1,1000))   ?>'> -->
                <a href='<?php echo $link; ?>'>
                <div class="team-item img" style="z-index: 1;">
                        <img class="img-fluid rounded-top w-100 fixed-size2" src="img/doktorlar/<?php echo  $satir_doktor['resim']?>" title="<?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?> "alt="<?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?>" style="max-width: 100%; max-height: 375px;">
                        
                    </div>
                    <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                        <h4 class="mb-2"><?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?></h4>
                        <p class="text-primary mb-0"><?php ml_yaz($dil,"$satir_doktor[uzmanlık]",)?></p>
                    </div>
            </a>
                </div>
            </div>

			
            
            
<?php        }     
            }      
?>         
            
            </div>
        </div>
    </div>
    

    
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/twentytwenty/jquery.event.move.js"></script>
    <script src="lib/twentytwenty/jquery.twentytwenty.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

