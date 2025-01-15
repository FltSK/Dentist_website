<!DOCTYPE html>
<?php
@session_start();
if ( isset($_SESSION['giris_yapan_uye']) ) {
    echo "<script language='javascript'>window.location='editor_index.php'</script>";
} 
include('../baglan.php');
?>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Yönetim Paneli</title>

    <!-- Custom fonts for this template-->
    <link href="admin_vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="admin_css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
										
							</div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>MineDent Yönetim Sistemi</b></h1>
                                    </div>
                                    <form method='post' id="giris_form" action='' class="user">
                                        <div class="form-group">
                                            <input type="email" required name='kullanici' class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Kullanıcı adı">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name='sifre' required class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Şifre">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <label for="login-dkod">Doğrulama Kodu : <img valign='middle' src="admin_img/img_kod.php" height="20" width="60" /></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" min="100" max="999" required name='kod' class="form-control form-control-user"
                                                id="exampleInputDKod"
                                                placeholder="Yukarıda gösterilen kodu giriniz">
                                        </div>
										<input type="submit" value="Giriş Yapmak İçin Tıklayınız" name="submit" style='height:40px;width:100%;font-size:13px;background-color: #a3d4b1;border-color: #4e73df;color: white;border-radius: 5px;'>
                                    </form>
                                    <hr>
									<div style='min-height:70px;' id='sonuc_giris'>
									<div class="text-center">
                                        <a class="small" href="sifremi_unuttum.php">Şifremi Unuttum?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="kayit.php">Üye olmak istiyorum!</a>
                                    </div>	
									</div>						
									
									
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>

<script type="text/javascript">
$(document).on('submit','form#giris_form',function giris(){
event.preventDefault(); // Tarayıcının form submit etmesini engelleyelim	
$('#sonuc_giris').html("<p><center><img src='admin_img/l.gif' height=24 width=24 /></center>");

$.ajax({
	type: 'POST',
	url: 'isle.php',
	data: $('form#giris_form').serialize() + '&islem=giris_kontrol&r='+Math.random(),
	success: function(ajaxCevap) {
$('#sonuc_giris').html(ajaxCevap);
	}
});
return false;
});
</script>