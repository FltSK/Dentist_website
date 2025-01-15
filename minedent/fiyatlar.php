<!DOCTYPE html>
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
<?php
include('baglan.php');
?>
<head>
    <meta charset="utf-8">
    <title>DentCare - Dental Clinic Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/twentytwenty/twentytwenty.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn"><?php ml_yaz($dil,"Fiyatlarımız")?></h1>
                <a href="" class="h4 text-white"><?php ml_yaz($dil,"Ana Sayfa")?></a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h4 text-white"><?php ml_yaz($dil,"Fiyatlar")?></a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Pricing Start -->

    
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="section-title mb-4">
                        <h5 class="position-relative d-inline-block text-primary text-uppercase"><?php ml_yaz($dil,"Fiyatlandırma Politikamız")?></h5>
                        <h1 class="display-5 mb-0"><?php ml_yaz($dil,"Diş Tedavisi İçin Uygun Fiyatlar Sunuyoruz")?></h1>
                    </div>
                    <p class="mb-4"><?php ml_yaz($dil,"$genel_bilgiler[hakkinda]")?></p>
                    <h5 class="text-uppercase text-primary wow fadeInUp" data-wow-delay="0.3s"><?php ml_yaz($dil,"Randevu için arayın.")?></h5>
                    <h1 class="wow fadeInUp" data-wow-delay="0.6s"><?php echo $genel_bilgiler['telefon'] ?></h1>
                </div>
      
                <div class="col-lg-7">
                    <div class="owl-carousel price-carousel wow zoomIn" data-wow-delay="0.9s">
<?php
	     $sorgu_hizmet = mysqli_query($conn,"select * from hizmetler");
	     $say_hizmet= mysqli_num_rows($sorgu_hizmet);
	  
		if ( $say_hizmet > 0 ) {
		  
			while ( $satir_hizmet = mysqli_fetch_array($sorgu_hizmet) ) {
                
?>
             
                        <div class="price-item pb-4">
                         <div class="position-relative">
                                <img class="img-fluid rounded-top fixed-size" src="img/hizmet/<?php echo  $satir_hizmet['resim']?>"title="<?php  ml_yaz($dil,"$satir_hizmet[hizmet]")?>" alt="">
                                <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                    <h2 class="text-primary m-0"><?php echo $satir_hizmet["fiyat"]."$" ?></h2>
                                </div>
                            </div>
                            <div class="position-relative text-center bg-light border-bottom border-primary py-5 p-4">
                                <h4><?php  ml_yaz($dil,"$satir_hizmet[hizmet]")?></h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                <div class="d-flex justify-content-between mb-3"><span><?php ml_yaz($dil,"Modern Ekipmanlar")?></span><i class="fa fa-check text-primary pt-1"></i></div>
                                <div class="d-flex justify-content-between mb-3"><span><?php ml_yaz($dil,"Profesyonel Diş Hekimleri")?></span><i class="fa fa-check text-primary pt-1"></i></div>
                                <div class="d-flex justify-content-between mb-2"><span>24/7 <?php ml_yaz($dil,"Çağrı Desteği")?></span><i class="fa fa-check text-primary pt-1"></i></div>
                                <a href="randevu?lang=<?php echo $dil?>" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle"><?php ml_yaz($dil,"Randevu")?></a>
                            </div>
             
                        </div>
            <?php
            } }
             ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->
 
 


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>

    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/twentytwenty/jquery.event.move.js"></script>
    <script src="lib/twentytwenty/jquery.twentytwenty.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>