<!DOCTYPE html>
<?php	
	include('lang.php');
	require_once('functions.php');
?>


<head>
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
<base href="http://localhost/minedent/minedent/">
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <meta charset="utf-8">
    <title>MineDent</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
   

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/twentytwenty/twentytwenty.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <?php
    $page = "index";	 
	include('header.php');
	?>
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->

    <!-- Full Screen Search End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown"><?php ml_yaz($dil,"Dişlerinizi sağlıklı tutun")?></h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn"><?php ml_yaz($dil,"En kaliteli diş tedavisini alın")?></h1>
                            <a href="randevu?<?php echo $dil?>" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft"><?php ml_yaz($dil,"Randevu")?></a>
                            <a href="iletisim?<?php echo $dil?>" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight"><?php ml_yaz($dil,"Bize Ulaşın")?></a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown"><?php ml_yaz($dil,"Dişlerinizi sağlıklı tutun")?></h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn"><?php ml_yaz($dil,"En kaliteli diş tedavisini alın")?></h1>
                            <a href="randevu?<?php echo $dil?>" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft"><?php ml_yaz($dil,"Randevu")?></a>
                            <a href="iletisim?<?php echo $dil?>" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight"><?php ml_yaz($dil,"Bize Ulaşın")?></a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Önceki</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sonraki</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Banner Start -->
    <div class="container-fluid banner mb-5">
        <div class="container">
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary d-flex flex-column p-5" style="height: 300px;">
                        <h3 class="text-white mb-3"><?php ml_yaz($dil,"Açılış Saatleri")?></h3>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <h6 class="text-white mb-0"><?php ml_yaz($dil,"Pzt - Cum")?></h6>
                            <p class="mb-0">08:00 - 20:00</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mb-3">
                            <h6 class="text-white mb-0"><?php ml_yaz($dil,"Cumartesi")?></h6>
                            <p class="mb-0"> 09:00 - 13:00</p>
                        </div>
                        <a href="randevu?<?php echo $dil?>" class="btn btn-light" href=""><?php ml_yaz($dil,"Randevu")?></a>
                    </div>
                </div>
             
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-secondary d-flex flex-column p-5" style="height: 300px;">
                        <h3 class="text-white mb-3"><?php ml_yaz($dil,"Randevu Oluşturun")?></h3>
                        <p class="text-white"><?php ml_yaz($dil,"Kolay")?>,<?php ml_yaz($dil,"kaliteli")?>,<?php ml_yaz($dil,"üstün")?>,<?php ml_yaz($dil,"sorunsuz ve profesyonel tedavi için hemen randevu alın")?>.</p>
                        <h2 class="text-white mb-0">+212 450 45 45 </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Start -->
    <div class="container-fluid text-light py-4" style="background: #051225;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white border-bottom" href="#">MineDent</a>. <?php ml_yaz($dil,"Tüm hakları saklıdır")?>.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0"> <a class="text-white border-bottom" href="rapor?<?php echo $dil?>"><?php ml_yaz($dil,"Proje Raporu")?></a></p>
                </div>
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
    <script>
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
  </script>
</body>

</html>