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
                    
					<h1 class="h3 mb-4 text-gray-800">Yeni Hizmet Ekleme</h1>					
						<div class="card-body">
						
		<div class="table-responsive">
		<table width='80%' >
		<tbody>
		<tr>
		<td>
			  <form id='hizmet_bilgileri' name='hizmet_bilgileri' method="post" enctype="multipart/form-data" action="isle.php?islem=hizmet_ekleme">  
			  <table class="table table-bordered" cellpadding="0" cellspacing="0">
				  <tr>
					<td><strong>Hizmet Resmi</strong></td>
					<td><input type='file' accept="image/gif, image/jpg, image/jpeg, image/png" name='hizmet_resim'></td>
				  </tr>
				  <tr>
					<td><strong>Adı</strong></td>
					<td><input type="text" class="text" required  name='hizmet_adi' /></td>
				  </tr>
				  <tr>
					<td><strong>Fiyatı</strong></td>
					<td><input type="text" class="text" required name='hizmet_fiyat' /></td>
				  </tr>
				  <tr>
					  <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
					  <td style="text-align:left; vertical-align: middle;">
							<input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Hizmeti Kaydet'>
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



