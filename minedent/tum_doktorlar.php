<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
<div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
               

    <?php
	  $sorgu_doktor = mysqli_query($conn,"select * from doktorlar AS D INNER JOIN UYELER AS U ON U.id = D.user_id ");
	  $say_doktor = mysqli_num_rows($sorgu_doktor);
	  $_GET['islem'] = 'doktor';
	
		include('islemler.php');
	    ?>
            
            </div>
        </div>
    </div>