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
                    
					<h1 class="h3 mb-4 text-gray-800">Doktor Bilgileri </h1>					
						<div class="card-body">
						

	<?php
	$sifreli_id_bs64 = @$_GET["doktor"]; 
	$sifreli_id = base64_decode($sifreli_id_bs64);

	$encryption_key = "sifreleme_123456";
	$y_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
	

	?>

				<?php
			$sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id WHERE D.user_id= $y_id ");
            $satir_doktor = mysqli_fetch_array($sorgu_doktor);
				?>
	
		<div class="table-responsive">
		<table width='80%' >
		<tbody>
		<tr>
		<td>
		<form id='doktor_bilgileri' name='doktor_bilgileri' method="post" enctype="multipart/form-data" action="isle.php?islem=doktor_duzenleme">  
    <table class="table table-bordered" cellpadding="0" cellspacing="0">
        <tr>
            <td style='text-align:center' colspan=2>
                <img style="border-radius: 53%;" width=175 height=175 src='../img/doktorlar/<?php echo $satir_doktor['resim'] ?>'>
            </td>
        </tr>
        <tr>
            <td><strong>Resim Değiştir</strong></td>
            <td><input type='file' accept="image/gif, image/jpg, image/jpeg, image/png" name='doktor_resim'></td>
        </tr>
        <tr>
            <td><strong>Adı</strong></td>
            <td><input type="text" class="text" required name='doktor_adi' value='<?php echo $satir_doktor['adi'] ?>' /></td>
        </tr>
        <tr>
            <td><strong>Soyadı</strong></td>
            <td><input type="text" class="text" required name='doktor_soyadi' value='<?php echo $satir_doktor['soyadi'] ?>' /></td>
        </tr>
        <tr>
            <td><strong>Cinsiyet</strong></td>
            <td>
                <input type="radio" required name='doktor_cinsiyeti'id='cinsiyetE' value='E' <?php echo $satir_doktor['cinsiyet'] == 'E' ? 'checked' : ''; ?> /> <label for="cinsiyetE">Erkek</label>  <br>
                <input type="radio" required name='doktor_cinsiyeti'id='cinsiyetK' value='K' <?php echo $satir_doktor['cinsiyet'] == 'K' ? 'checked' : ''; ?> /> <label for="cinsiyetK">Kadın</label>
            </td>
        </tr>
        <tr>
            <td><strong>Uzmanlık</strong></td>
            <td><input type="text" class="text" required name='doktor_uzmanlik' value='<?php echo $satir_doktor['uzmanlık'] ?>'/></td>
        </tr>
        <tr>
            <td><strong>Muayene Odası</strong></td>
            <td>
                <select required name="doktor_muayene_odasi">
                    <option value='<?php echo $satir_doktor['muayene_odasi'] ?>'><?php echo $satir_doktor['muayene_odasi'] ?></option>
                    <?php 
                    $sorgu_odalar = mysqli_query($conn, "SELECT DISTINCT muayene_odasi FROM doktorlar WHERE muayene_odasi != '{$satir_doktor['muayene_odasi']}'");
                    while ($satir_oda = mysqli_fetch_array($sorgu_odalar)) {
                        echo "<option value='{$satir_oda['muayene_odasi']}'>{$satir_oda['muayene_odasi']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan=2><strong>Hakkında</strong></td>
        </tr>
        <tr>
            <td colspan=2>
                <div style='width:99%'>
                    <textarea id='doktor_ozgecmis' name="doktor_ozgecmis"><?php echo $satir_doktor['ozgecmis']; ?></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
            <td style="text-align:left; vertical-align: middle;">
                <input type="hidden" name='doktor_id' value='<?php echo $sifreli_id_bs64; ?>' />
                <input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Doktor Bilgilerini Kaydet'>
                <a href="isle.php?islem=doktor_silme&doktor_id=<?php echo $sifreli_id_bs64; ?>" class="doktor_sil_button" onclick="return confirm('Doktoru silmek istediğinizden emin misiniz?')">
                    Doktor Sil
                </a>
            </td>
        </tr>
    	</table>        
		</form>	




		
		
	
 
	</div>	
	</div>
	
	
<script>
      ClassicEditor
      .create( document.querySelector( '#doktor_ozgecmis' ), {
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
  $('form#doktor_bilgileri').submit(function(event) {
    event.preventDefault(); 
		$('#sonuc').fadeIn().html("<img src=admin_img/l.gif width=24 height=24 valign='middle'>");
    var form = $(this);
    var formVeri= new FormData($('form#doktor_bilgileri')[0]);   
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



