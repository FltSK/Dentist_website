<!DOCTYPE html>
<?php
include('../baglan.php');
$sorgu_temel = mysqli_query($conn,"select * from genel_bilgiler");
$satir_temel = mysqli_fetch_array($sorgu_temel);
?>
<html lang="tr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $satir_temel['site_adi']; ?></title>

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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2"><b>Şifremi Unuttum</b></h1>
									</div>
									<div class="text-justify">
                                        <p class="mb-4">
										<div style='font-size:0.8rem;'>
										Aşağıdaki kutucuğa mail adresinizi yazınız.
										Sistemde tanımlı olan mail adresinize şifre sıfırlama linki gönderilecektir.
										</div>
										</p>
                                    </div>
                                    <form id='sifre_sifirlama' method='post' action='' class="user">
                                        <div class="form-group">
                                            <input type="email" required name='kullanici'  class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Mail adresi">
                                        </div>
									<div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <label for="login-dkod">Doğrulama Kodu : <img valign='middle' src="admin_img/img_kod.php" height="20" width="60" /></label>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <input type="number" min="100" max="999" required name='kod' class="form-control form-control-user"
                                                id="exampleInputDKod"
                                                placeholder="Yukarıdaki kodu giriniz">
                                        </div>
								<input type="submit" value="Şifremi Sıfırla" name="submit" style='height:40px;width:100%;font-size:13px;background-color:#a3d4b1;border-color:#a3d4b1;color: white;border-radius: 5px;'>
                                </form>                                    
									<div style='min-height:50px;color:red;font-size:0.8rem;' class="text-center" id='sonuc_sifre_sifirlama'>
									</div>
									<hr>									
									<div class="text-center">
                                        <a class="small" href="kayit.php">Üye olmak istiyorum!</a>
                                    </div>	
                                    <div class="text-center">
                                        <a class="small" href="index.php">Zaten üyeyim, giriş yapmak istiyorum!</a>
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
$(document).on('submit','form#sifre_sifirlama',function sifremi_unuttum(){
	event.preventDefault(); // Tarayıcının form submit etmesini engelleyelim
$('#sonuc_sifre_sifirlama').html("<p><center><img src='admin_img/l.gif' height=24 width=24 /></center>");

$.ajax({
	type: 'POST',
	url: 'isle.php',
	data: $('form#sifre_sifirlama').serialize() + '&islem=sifre_hatirlatma&r='+Math.random(),
	success: function(ajaxCevap) {
$('#form_alani').hide();
$('#sonuc_sifre_sifirlama').html(ajaxCevap);
	}
});
		
});
</script>