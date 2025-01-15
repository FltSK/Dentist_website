
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

			<h1 class="h3 mb-4 text-gray-800">Hizmet Bilgileri </h1>	
			<h1 class="h5 mb-4 text-gray-800">Düzenlemek için resime tıklayınız. </h1>					
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width='60%' id="dataTable" cellpadding="0" cellspacing="0">
			<thead>
			  <tr>
				<th style='text-align:center' width="20%"></th>
				<th style='text-align:center' width="30%">Hzimet</th>
				<th style='text-align:center' width="30%">Fiyatı</th>
			  </tr>
			<thead>
			<tbody>
				<?php 
	 	$sorgu_fiyat = mysqli_query($conn,"select * from hizmetler");
		
					while ( $satir_fiyat = mysqli_fetch_array($sorgu_fiyat)) {
						$y_id = $satir_fiyat['id'];
						
				
				
			
				$encryption_key = "sifreleme_123456";
				$sifreli_id = openssl_encrypt($y_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				$sifreli_id = base64_encode($sifreli_id);
				?>
			
				<tr>
				<td style="text-align:center; vertical-align: middle;"><a href="?istek=fiyat_detay&fiyat=<?php echo $sifreli_id; ?>"> <img style="border-radius: 23%;" width=75 height=75 src="../img/hizmet/<?php echo $satir_fiyat['resim']; ?>"></a></td>
				<td style="color:red; text-align:center; vertical-align: middle;"><?php echo $satir_fiyat['hizmet']; ?></td>
				<td style="color:blue; text-align:center; vertical-align: middle;"><?php echo $satir_fiyat['fiyat'].'$'; ?></td>
			   </tr>
				<?php } ?>
			</tbody>			
			</table>
		</div>
		</div>		
