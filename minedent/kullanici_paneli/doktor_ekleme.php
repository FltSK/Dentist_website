<?php
include_once('editor_fonks.php');
include_once('editor_ses_kontrol.php');
	if ( $yetki_seviyesi <> 3 ) {
		yazdir_yetkisiz_islem();
		die;
	}
	
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
					<h1 class="h3 mb-4 text-gray-800">Yeni Doktor Ekleme</h1>					
						<div class="card-body">
						
		<div class="table-responsive">
		<table width='80%' >
		<tbody>
		<tr>
		<td>
			  <form id='doktor_bilgileri' name='doktor_bilgileri' method="post" enctype="multipart/form-data" action="isle.php?islem=doktor_ekleme">  
			  <table class="table table-bordered" cellpadding="0" cellspacing="0">
				  <tr>
					<td><strong>Profil Resmi</strong></td>
					<td><input type='file' accept="image/gif, image/jpg, image/jpeg, image/png" name='doktor_resim'></td>
				  </tr>
				  <tr>
					<td><strong>Adı</strong></td>
					<td><input type="text" class="text" required  name='doktor_adi' /></td>
				  </tr>
				  <tr>
					<td><strong>Soyadı</strong></td>
					<td><input type="text" class="text" required  name='doktor_soyadi' /></td>
				  </tr>
				  <tr>
					<td><strong>E-Mail</strong></td>
					<td><input type="email" class="text" required  name='doktor_email' /> <span>ŞİFRE MAİLE GÖNDERİLECEKTİR.</span></td>
				  </tr>
				  <tr>
					<td><strong>Cinsiyet</strong></td>
					<td>
						<input type="radio" required  name='doktor_cinsiyeti' value='E' /> Erkek  <br>
						<input type="radio" required  name='doktor_cinsiyeti' value='K' /> Kadın
					</td>
				  </tr>
				  <tr>
					<td><strong>Uzmanlık</strong></td>
					<td><input type="text" class="text" required name='doktor_uzmanlik' /></td>
				  </tr>
				  <tr>
					<td><strong>Muayene Odası</strong></td>
					<td>
                	<select name="doktor_muayene_odasi" required>
                    <option value="">Muayene Odası Seçin</option>

					<?php 
					$sorgu_doktor = mysqli_query($conn,"select * from doktorlar");
					$say_doktor = mysqli_num_rows($sorgu_doktor);
					
					
					if ( $say_doktor > 0 ) {
					while($satir_doktor = mysqli_fetch_array($sorgu_doktor)){ ?>
                    <option value=<?php echo $satir_doktor['muayene_odasi'] ?>><?php echo $satir_doktor['muayene_odasi'] ?></option>

					<?php
				     }} ?>
                	</select>
                 	</td>
                  </tr>
				  <tr>
					<td colspan=2><strong>Hakkında</strong></td>
				  </tr>
				  <tr>
					<td colspan=2>
					<div style='width:99%'>
					<textarea id='doktor_ozgecmis' name="doktor_ozgecmis"> </textarea>
					</div>
					</td>
				  </tr>
				  <tr>
					  <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
					  <td style="text-align:left; vertical-align: middle;">
							<input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Doktor Kaydet'>
						</td>
				 </tr>
				</table>        
			  </form>

		</td>
		</tr>
		</tbody>			
		</table>
		</div>
	
 
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



