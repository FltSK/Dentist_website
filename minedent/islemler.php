
<?php
	include('baglan.php');			  
	sleep(1);
	
	$islem = @$_GET['islem'];
	
	if ( $islem == 'iletisim'  ) {	
			$ip = $_SERVER['REMOTE_ADDR'];
			$ad_soyad = mysqli_real_escape_string($conn,@$_GET['ad_soyad']);
			$tel = mysqli_real_escape_string($conn,@$_GET['tel']);
			$mail = mysqli_real_escape_string($conn,@$_GET['mail']);
			$mesaj = mysqli_real_escape_string($conn,@$_GET['mesaj']);
			
		$sql = "insert into iletisim_mesajlari( ad_soyad, tel, mail, mesaj, ip) values ('$ad_soyad', '$tel', '$mail', '$mesaj', '$ip' )";

			if (mysqli_query($conn,$sql)) {
                echo "<center><img src='img/gifler/verified.gif' width=96><br>Teşekkürler<p>";
				echo "Mesajınız Gönderildi</center>";
			} else{ echo "Beklenmeyen bir hata oluştu.";
			}
	}elseif($islem=='doktor'){
		$sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id ");
		if ( $say_doktor > 0 ) {
		  
			while ( $satir_doktor = mysqli_fetch_array($sorgu_doktor) ) {
        $link_yazar= doktor_url( $satir_doktor['id'],$satir_doktor['adi'].' '.$satir_doktor['soyadi']);
    
        echo "<div class='col-lg-4 wow slideInUp' data-wow-delay='0.1s'>";
                echo"<div class='team-item'>";
				?>
                <a href='<?php echo $link_yazar; ?>'>
				<!-- // <a href='?sayfa=doktor&id=((<?php echo hash('sha256',rand(1,1000)).$satir_doktor['id'].hash('sha256',rand(1,1000))   ?>>  -->
			     
                    <div class="team-item img" style="z-index: 1;">
                        <img class="img-fluid rounded-top w-100 fixed-size2" src="img/doktorlar/<?php echo  $satir_doktor['resim']?>" title="<?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?> "alt="<?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?>" style="max-width: 100%; max-height: 375px;">
                        
                    </div>
                    <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                        <h4 class="mb-2"><?php echo  $satir_doktor['adi']." ".$satir_doktor['soyadi']   ?></h4>
                        <p class="text-primary mb-0"><?php echo $satir_doktor['uzmanlık']?></p>
                    </div>
            </a>
                </div>
            </div>
        <?php
       		}     
		}     
     
	


	}else {
		echo "Geçersiz İstek <br>";
	}
?>
</body>
</html>