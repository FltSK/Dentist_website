<!DOCTYPE html>
<?php

include('lang.php');
require_once('functions.php');
include('baglan.php');
$sorgu_gnl = mysqli_query($conn,"select * from genel_bilgiler");
$genel_bilgiler = mysqli_fetch_array($sorgu_gnl);
?>
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $genel_bilgiler['site_adi'] ?></title>
    <base href="http://localhost/minedent/minedent/">
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
    <!-- Topbar Start -->
    <?php
    $page = "anasayfa";	 
	include('header.php');
	?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    
    <!-- Navbar End -->

</body>
<div>
    <?php
    $sayfa_param = @$_GET['sayfa'];
    $sayfa_parts = explode('?', $sayfa_param);

    $sayfa_id = $sayfa_parts[0];
    if ( isset($sayfa_id) == false ) {
        $sayfa_id = 'hakkinda';
    }
    if ( $sayfa_id == 'hakkinda'  ) {
        include('hakkinda.php');
    } elseif ( $sayfa_id == 'doktorlar' ) {
        include('doktorlar.php');
    } elseif ( $sayfa_id == 'hizmetler' ) {
        include('hizmetler.php');
    } elseif ( $sayfa_id == 'iletisim' ) {
        include('iletisim.php');
    } elseif ( $sayfa_id == 'randevu' ) {
        include('randevu.php');
    } elseif ( $sayfa_id == 'fiyatlar' ) {
        include('fiyatlar.php');
    } elseif (  $sayfa_id == "rapor"  ) {
        include('rapor.php');
    }elseif (  $sayfa_id == "kayit"  ) {
        include('kayit.php');
    }elseif (  $sayfa_id == "doktor"  ) {
        include('doktor.php');
    }elseif (  $sayfa_id == "tum_doktorlar") {
        include('tum_doktorlar.php');
    }
    else {
        include('hakkinda.php');
    }
    ?>
</div>
<!-- <console class="log"><?php //echo $sayfa_id ?></console> -->

  


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


</html>