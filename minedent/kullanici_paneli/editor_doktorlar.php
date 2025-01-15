<?php
include_once('editor_fonks.php');
include_once('editor_ses_kontrol.php');
	if ( $yetki_seviyesi <> 3 ) {
		yazdir_yetkisiz_islem();
		die;
	}
	
?>
    <?php
	$doktor_basharf = @$_REQUEST["doktor_basharf"]; 
	// echo $doktor_basharf;
?>	            <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
					<h1 class="h3 mb-4 text-gray-800">Doktorlar </h1>					
						<div class="card-body">
						
		<div id="doktor_tablosu">
		<form id='doktor_harf_sec' name='doktor_harf_sec' method="post" action="#">
		<h1 class="h5 mb-4 text-gray-800">Düzenlemek için resime tıklayınız. </h1>	
	<?php 
	$sorgu_doktor_ilkharfler = mysqli_query($conn,"select substr(adi,1,1) as harf, count(id) as sayi 
										from uyeler where uyelik_turu=3 group by substr(adi,1,1)");
	?>
		
         <p style='text-align: right;'> Seçiniz: <select id='doktor_basharf' name='doktor_basharf'>
			<option <?php echo ($doktor_basharf == 'tum') ? "selected" : ""; ?> value='tum'>#</option>
			<?php 
			while ( $satir_ilkharf = mysqli_fetch_array($sorgu_doktor_ilkharfler)) {
				?>				
			<option <?php echo ( $doktor_basharf == $satir_ilkharf['harf']) ? "selected" : "" ?> value='<?php echo $satir_ilkharf['harf']?>'><?php echo $satir_ilkharf['harf']?></option>
	<?php 
	}	
	?>
          </select>
		  </p>
		  </form>
		<div class="table-responsive">
			<table class="table table-bordered" width='60%' id="dataTable" cellpadding="0" cellspacing="0">
			<thead>
			  <tr>
				<th style='text-align:center' width="20%"></th>
				<th style='text-align:center' width="30%">Adı</th>
				<th style='text-align:center' width="30%">Soyadı</th>
				<th style='text-align:center' width="20%">Uzmanlık</th>
				<th style='text-align:center' width="20%">Muayene Odası</th>
			  </tr>
			<thead>
			<tbody>
				<?php
		if ( $doktor_basharf == 'tum' )  {
			$sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id where u.uyelik_turu=3 order by adi,soyadi asc");
		} else { 
	 	$sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id where uyelik_turu=3 and substr(adi,1,1) = '$doktor_basharf' order by adi, soyadi asc");
		}
					while ( $satir_doktor = mysqli_fetch_array($sorgu_doktor)) {
						$y_id = $satir_doktor['id'];
						
				
				
			
				$encryption_key = "sifreleme_123456";
				$sifreli_id = openssl_encrypt($y_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				$sifreli_id = base64_encode($sifreli_id);
				?>
			
				<tr>
				<td style="text-align:center; vertical-align: middle;"><a href="?istek=doktor_detay&doktor=<?php echo $sifreli_id; ?>"> <img style="border-radius: 23%;" width=75 height=75 src="../img/doktorlar/<?php echo $satir_doktor['resim']; ?>"></a></td>
				<td style="color:red; text-align:center; vertical-align: middle;"><?php echo $satir_doktor['adi']; ?></td>
				<td style="color:blue; text-align:center; vertical-align: middle;"><?php echo $satir_doktor['soyadi']; ?></td>
				<td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $satir_doktor['uzmanlık'] ?></td>
				<td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $satir_doktor['muayene_odasi'] ?></td>
			   </tr>
				<?php } ?>
			</tbody>			
			</table>
		</div>
		</div>		


						

<script>
  // Get the select element
  var select = document.getElementById("doktor_basharf");
  select.addEventListener("change", function() {
    var selectedOption = select.value;
    document.getElementById("doktor_harf_sec").action = "editor_index.php?istek=doktorlar&doktor_basharf=" + selectedOption;
    document.getElementById("doktor_harf_sec").submit();
  });
</script>
