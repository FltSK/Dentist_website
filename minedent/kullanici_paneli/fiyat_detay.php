<?php
include_once('editor_fonks.php');
include_once('editor_ses_kontrol.php');
	if ( $yetki_seviyesi <> 3) {
		yazdir_yetkisiz_islem();
		die;
	}
	
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
					<h1 class="h3 mb-4 text-gray-800">Hizmet Bilgileri </h1>					
						<div class="card-body">
						

	<?php
	$sifreli_id_bs64 = @$_GET["fiyat"]; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	// echo $sifreli_id;
	$encryption_key = "sifreleme_123456";
	$y_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
	
	/*
	if ($y_id === false) {
    echo 'Şifre çözme başarısız oldu: ' . openssl_error_string();
	}   else {
    echo 'Şifre çözme başarılı: ' . $y_id;
	}
	 */	
	?>

				<?php
			$sorgu_hizmet = mysqli_query($conn,"select * from hizmetler where id = $y_id ");
            $satir_hizmet = mysqli_fetch_array($sorgu_hizmet);
			// $sorgu_kitap = mysqli_query($conn,"select * from kitaplar where hizmet_id = $y_id ");
			// $ks = mysqli_num_rows($sorgu_kitap);
				?>
	
		<div class="table-responsive">
		<table width='80%' >
		<tbody>
		<tr>
		<td>
		<form id='hizmet_bilgileri' name='hizmet_bilgileri' method="post" enctype="multipart/form-data" action="isle.php?islem=fiyat_duzenleme">  
    <table class="table table-bordered" cellpadding="0" cellspacing="0">
        <tr>
            <td style='text-align:center' colspan=2>
                <img style="border-radius: 53%;" width=175 height=175 src='../img/hizmet/<?php echo $satir_hizmet['resim'] ?>'>
            </td>
        </tr>
        <tr>
            <td><strong>Resim Değiştir</strong></td>
            <td><input type='file' accept="image/gif, image/jpg, image/jpeg, image/png" name='hizmet_resim'></td>
        </tr>
        <tr>
            <td><strong>Hizmet</strong></td>
            <td><input type="text" class="text" required name='hizmet_adi' value='<?php echo $satir_hizmet['hizmet'] ?>' /></td>
        </tr>
        <tr>
            <td><strong>Fiyat</strong></td>
            <td><input type="text" class="text" required name='hizmet_fiyat' value='<?php echo $satir_hizmet['fiyat']."$" ?>'/></td>
        </tr>
        <tr>
            <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
            <td style="text-align:left; vertical-align: middle;">
                <input type="hidden" name='hizmet_id' value='<?php echo $sifreli_id_bs64; ?>' />
                <input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Hizmet Bilgilerini Kaydet'>
                <a href="isle.php?islem=hizmet_silme&hizmet_id=<?php echo $sifreli_id_bs64; ?>" class="doktor_sil_button" onclick="return confirm('hizmetu silmek istediğinizden emin misiniz?')">
                    Hizmet Sil
                </a>
            </td>
        </tr>
    	</table>        
		</form>	
	</div>	
	</div>
	
	
<script>
      ClassicEditor
      .create( document.querySelector( '#hizmet_ozgecmis' ), {
		language: 'tr',
		mediaEmbed: {
             previewsInData:true
        }
        } )
        .then( editor => {
          console.log(editor);
        })
        .catch( error => {
            console.error( error );
        } );
</script>

  <script>
  // ajax    
  $('form#hizmet_bilgileri').submit(function(event) {
    event.preventDefault(); 
		$('#sonuc').fadeIn().html("<img src=admin_img/l.gif width=24 height=24 valign='middle'>");
    var form = $(this);
    var formVeri= new FormData($('form#hizmet_bilgileri')[0]);   
    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
	  contentType: form.attr('enctype'),
      processData: false,
      contentType: false,
      data: formVeri,
	        success: function(response) {
                $('#sonuc').html(response);
            }  
	  });
  });	 
</script>



