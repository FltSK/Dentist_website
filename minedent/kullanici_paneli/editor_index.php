<!DOCTYPE html>
<html lang="tr">
<?php
session_start();
include('editor_fonks.php');
include('editor_ses_kontrol.php');
$kid = $_SESSION['giris_yapan_uye'];
include('../baglan.php');

	$sorgu = mysqli_query($conn,"select * from uyeler where id='$kid' ");
    $satir = mysqli_fetch_array($sorgu);
	$toplam_sayi = mysqli_query($conn,"SELECT SUM(giris_sayisi) AS toplam_giris_sayisi FROM uyeler");
	$toplam_sayi_satir =mysqli_fetch_array($toplam_sayi);
	
    $doktor_sayi_sorgu=mysqli_query($conn,"SELECT COUNT(*) as satir_sayisi from doktorlar ");
    $doktor_sayi_sorgu_satir=mysqli_fetch_array($doktor_sayi_sorgu);

    $uye_sayi_sorgu=mysqli_query($conn,"SELECT COUNT(*) as uye_sayisi FROM uyeler WHERE uyelik_turu NOT IN (1, 3)");
    $uye_sayi_sorgu_satir=mysqli_fetch_array($uye_sayi_sorgu);
    $id = @$_GET['istek'];

?>
<head>
    <link href="admin_img/favicon.ico" rel="icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Editör Paneli </title>

    <!-- Custom fonts for this template-->
    <link href="admin_vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="admin_css/sb-admin-2.min.css" rel="stylesheet">
	<link href="admin_css/ek.css" rel="stylesheet">
	
	    <script src="admin_vendor/jquery/jquery.min.js"></script>
		
	<script src="admin_vendor/ckeditor5-41.2.1-usmxa9flxj4t/build/ckeditor.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
	
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="editor_index.php">
                <div class="sidebar-brand-text mx-3">Kullanıcı Paneli</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="editor_index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Anasayfa</span></a>
            </li>
			<?php
			
				if ( $yetki_seviyesi == 3 ) {
			?>

            <!-- Divider -->
            <hr class="sidebar-divider">

             <!-- Heading -->
            <div class="sidebar-heading">
                Doktorlar
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="?istek=doktorlar&doktor_basharf=tum">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Doktor Düzenleme</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=doktor_ekleme">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Doktor Ekleme</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                Fiyat İşlemleri
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="?istek=fiyat_duzenleme">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Fiyat Düzenleme</span></a><!-- indirim fonksiyonu yaz -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=hizmet_ekleme">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Hizmet Ekleme</span></a><!-- indirim fonksiyonu yaz -->
            </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
			
            <!-- Heading -->
            <div class="sidebar-heading">
                Randevu İşlemleri
            </div>	
            <li class="nav-item">
                <a class="nav-link" href="?istek=randevu_yonet">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Randevu Düzenleme</span></a>
            </li>	

          
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <?php
				} 
			if ( $yetki_seviyesi > 1 ) {
			?>
            <!-- Heading -->
            <div class="sidebar-heading">
                Doktor İşlemleri<!-- doktorun Hastalarını listelicek -->
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="?istek=hasta_listeleme">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Hastalarım</span></a>
            </li>

            <?php
				}
			?>
        

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

			<?php
				
			if ( $yetki_seviyesi >= 1 ) {
			?>

            <!-- Heading -->
            <div class="sidebar-heading">
               Hasta İşlemleri
            </div>	
            <li class="nav-item">
                <a class="nav-link" href="?istek=randevularım">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Randevularım</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=randevu_al">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Randevu al</span></a>
            </li>			

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">			
			
			<?php
				}
			?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $satir['adi']." ".$satir['soyadi']; ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="cikis.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Çıkış
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
				
				   <?php 
		if ( $id == "doktor_ekleme" ) {
			include('doktor_ekleme.php');
		} elseif ( $id == "doktorlar" ) {
			include('editor_doktorlar.php');
		} elseif ( $id == "doktor_detay" ) {
			include('editor_doktor_detay.php');
		} elseif ( $id == "fiyat_duzenleme" ) {
			include('fiyat_duzenleme.php');
		}elseif ( $id == "fiyat_detay" ) {
			include('fiyat_detay.php');
		}elseif ( $id == "hizmet_ekleme" ) {
			include('hizmet_ekleme.php');
		}elseif ( $id == "randevu_al" ) {
			include('randevu_al.php');
		}elseif ( $id == "randevularım" ) {
			include('randevularım.php');
		}elseif ( $id == "hasta_listeleme" ) {
			include('hastalarim.php');
		}elseif ( $id == "randevu_yonet" ) {
			include('randevu_yonet.php');
		}
		else{
		?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Anasayfa</h1>                        
                    </div>

				
                 <!-- Content Row --><?php
                 if ( $yetki_seviyesi == 3 ) {
                    ?>
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ziyaret (Toplam)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $toplam_sayi_satir['toplam_giris_sayisi'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Doktor Sayısı</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $doktor_sayi_sorgu_satir['satir_sayisi'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Hasta Sayısı
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $uye_sayi_sorgu_satir['uye_sayisi']?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        
                    </div>
                </div>
                <?php
                        }
                        ?>
                <div class="mt-4 text-center">
                <h2 style="font-family: Arial, sans-serif; color: #333;">Minedent kullanıcı paneline hoş geldiniz.</h2>
                </div>
   				

                <!-- /.container-fluid -->
		<?php
		}
		?>

            </div>
            <!-- End of Main Content -->
            
            <!-- Footer -->
            <div style="min-height: 100vh; padding-bottom: 4rem;">
    <!-- Sayfa içeriğiniz burada yer alacak -->
</div>

<div class="container-fluid text-light py-4" style="background: #051225; position: sticky; bottom: 0; left: 0; right: 0; width: calc(100%); box-sizing: border-box;">
    <div class="container" style="padding: 0; margin: 0; max-width: 100%;">
        <div class="row g-0" style="margin: 0;">
            <div class="container my-auto" style="margin: 0; padding: 0; max-width: 100%;">
                <div class="copyright text-center my-auto" style="margin: 0;">
                    <span>Copyright &copy; MediDent Yönetim Sistemi</span>
                </div>
            </div>
        </div>
    </div>
</div>










            <!--footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MediDent Yönetim Sistemi</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış Onay</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Oturumu sonlandırmak istediğinize eminmisiniz?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                    <a class="btn btn-primary" href="cikis.php">Çıkış</a>
                </div>
            </div>
        </div>
    </div>

 <!-- Bootstrap core JavaScript-->
    <script src="admin_vendor/jquery/jquery.min.js"></script>
    <script src="admin_vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin_vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin_js/sb-admin-2.min.js"></script>


    <!-- Page level plugins -->
    <script src="admin_vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin_js/demo/datatables-demo.js"></script>	

</body>

</html>











