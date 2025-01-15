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

	<style>
	.kucuk_harf_input {
		text-transform: lowercase;
		&::placeholder {
		text-transform: none;
		}
	}
	</style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>Üyelik Başvurusu</b></h1>
                            </div>
							<div id='form_alani'>
                            <form class="user" method='post' id="uye_form" action=''>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" required name='ad' class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Adınız">
                                    </div>
                                    <div class="col-sm-6">
                                        <input name='soyad' type="text" required class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Soyadınız">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name='e-mail' type="email" required class="form-control form-control-user kucuk_harf_input" id="exampleInputEmail"
                                        placeholder="Email Adresiniz">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name='tel' pattern="[0-9]{11}" placeholder='GSM Örnek : 05321234567'  type="tel" required class="form-control form-control-user"
                                            id="exampleInputTel">
                                    </div>
                                    <div class="col-sm-6">
									        <input type="date" min="1940-01-01" max="2018-01-01" required name='dtarih' class="form-control form-control-user"
                                            id="exampleBirdYear" placeholder="Doğum Tarihiniz">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                 							<input type="radio" class="form-check-input" name="cinsiyet" id='cinsiyetK' value="K" checked> <label for="cinsiyetK">Kadın</label>
				                   
                                    </div>
                                    <div class="col-sm-6">
									        <input type="radio" class="form-check-input" name="cinsiyet" id='cinsiyetE' value="E"> <label for="cinsiyetE">Erkek</label>
                                    </div>
                                </div>
								<input type="submit" value="Kayıt Gönder" name="submit" style='height:40px;width:100%;font-size:13px;background-color: #a3d4b1;border-color: #a3d4b1;color: white;border-radius: 5px;'>

                            </form>
							</div>
							<div id='sonuc_uye'>
							</div>
                            <hr>
     						<div class="text-center">
                                        <a class="small" href="sifremi_unuttum.php">Şifremi Unuttum?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Zaten üyeyim, giriş yapmak istiyorum!</a>
                                    </div>	
									<?php
							//		$md5yap=md5(rand(0,999999));
							//		echo $md5yap."<br>";
							//		$sifre = strtoupper(substr($md5yap, 5, 10));
							//		echo $sifre;
									?>
									
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
$(document).on('submit','form#uye_form',function giris(){
event.preventDefault(); // Tarayıcının form submit etmesini engelleyelim	
$('#sonuc_uye').html("<p><center><img src='admin_img/l.gif' height=24 width=24 /></center>");


$.ajax({
	type: 'POST',
	url: 'isle.php',
	data: $('form#uye_form').serialize() + '&islem=uye_ol_form&r='+Math.random(),
	success: function(ajaxCevap) {
$('#form_alani').hide();
$('#sonuc_uye').html(ajaxCevap);
$('html,body').animate({scrollTop: $('#sonuc_uye').offset().top}, 723);	
	}
});
return false;
});

</script>