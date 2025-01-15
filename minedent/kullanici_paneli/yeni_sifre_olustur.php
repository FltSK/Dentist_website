<!DOCTYPE html>
<?php
include('../baglan.php');
	$sorgu_genel = mysqli_query($conn,"select * from genel_bilgiler");
	$satir_genel = mysqli_fetch_array($sorgu_genel);

$uye_bilgi = @$_GET['id'];

$uye_bilgi =  substr($uye_bilgi, 64);   // baştan 64. karakter silelim
$uye_id =  substr($uye_bilgi, 0, -64);   // sondan 64. karakter silelim

echo "<center>";
if ( !isset($_GET['id']) ) {
	   echo "<img src='admin_img/hata.png' width='48' height='48'><br>";
	   echo "Hatalı işlem. Kod : 51";
     //  echo "hata 51 : id tanımlı değil";
       die();
  }

  $sorgu = mysqli_query($conn,"Select * from uyeler where id='$uye_id'");
  $say_uye = mysqli_num_rows($sorgu);
  
  if (   $say_uye == 0  ) {
	echo "<img src='admin_img/hata.png' width='48' height='48'><br>";
	echo "Hatalı işlem. Kod : 52";
    // echo "hata 52 : geçerli kullanıcı yok";
    die();
  } else   {

	  $satir = mysqli_fetch_array($sorgu);	  
      $uye_mail = $satir['mail'];
      $sifre_istegi = $satir['sifre_istek'];
      $istek_tarihi = $satir['sifre_istek_tarihi'];
  }

  if ( $sifre_istegi == 0 ) {
	echo "<img src='admin_img/hata.png' width='48' height='48'><br>";
	echo "Hatalı işlem. Kod : 53";
   // echo "hata 53 : Üyenin şifre değiştirme isteği yok";
    die();
}

date_default_timezone_set('Europe/Istanbul');
$simdiki_zaman = date("Y-m-d H:i:s");

$gecen_saniye = abs(strtotime($simdiki_zaman) - strtotime($istek_tarihi));
$gecen_dakika = $gecen_saniye/60;

 //echo "Geçen dakika : ".$gecen_dakika;

if ( $gecen_dakika > 60 ) {
  echo "<img src='admin_img/hata.png' width='48' height='48'><br>";
  echo "Hatalı işlem. Kod : 54 <br>";
  echo "Şifre değiştirme linkinin süresi dolmuştur.";
  die();
}
echo "</center>";
?>
<html lang="tr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $satir_genel['site_adi']; ?></title>

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
                                        <h1 class="h4 text-gray-900 mb-2"><b>Yeni Şifre Oluştur</b></h1>
									</div>
									<div class="text-justify">
                                        <p class="mb-4">
										<div style='font-size:0.8rem;'>
										Aşağıdaki kutucuğa mail adresinizi veya kullanıcı adınızı yazınız.
										Sistemde tanımlı olan mail adresinize şifre sıfırlama linki gönderilecektir.
										</div>
										</p>
                                    </div>
                                    <form id='sifre_sifirlama' method='post' action='' class="user">
                                        <div class="form-group">
                                            <input value='<?php echo $uye_mail; ?>' name='kullanici' type="text" readonly  class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Mail adresi veya kullanıcı adı">
                                        </div>
									    <div class="form-group">
                                            <input type="text" name='sifre' minlength="5" maxlength="21" required class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Yeni Şifre">
                                        </div>
									    <div class="form-group">
                                            <input type="text" name='tsifre' minlength="5" maxlength="21" required class="form-control form-control-user"
                                                id="exampleInputRePassword" placeholder="Yeni Şifre (Tekrar)">
                                        </div>
								<input type="submit" value="Şifremi Sıfırla" name="submit" style='height:40px;width:100%;font-size:13px;background-color: #4e73df;border-color: #4e73df;color: white;border-radius: 5px;'>
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
$(document).on('submit','form#sifre_sifirlama',function sifremi_sifirla(){
	event.preventDefault(); // Tarayıcının form submit etmesini engelleyelim
$('#sonuc_sifre_sifirlama').html("<p><center><img src='admin_img/l.gif' height=24 width=24 /></center>");

$.ajax({
	type: 'POST',
	url: 'isle.php',
	data: $('form#sifre_sifirlama').serialize() + '&islem=yeni_sifre&r='+Math.random(),
	success: function(ajaxCevap) {
$('#sonuc_sifre_sifirlama').html(ajaxCevap);
	}
});
		
});
</script>