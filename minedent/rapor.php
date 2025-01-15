<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>		
  <link href="moduller/fotorama/4.6.4/fotorama.css" rel="stylesheet">
  <script src="moduller/fotorama/4.6.4/fotorama.js"></script>
<!DOCTYPE html>
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>
<!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <h2 class="main-heading ">
        <?php echo $genel_bilgiler['site_adi'] ?> Proje Raporu
      </h2>
      <p align=justify >
      <?php ml_yaz($dil,"Projede front end için hazır bir şablon kullanılarak Ağız ve Diş sağlığı sağlık kuruluşu sitesi planlanmıştır. Randevu alma randevularım paneli gibi kullanışlı özellikler projede kullanılmıştır")?>
<?php ml_yaz($dil,"Projenin yapımında kullanılan araçlar")?> :
		<ul>
			<li>PHP, HTML5</li>			
			<li><a target='_blank' href='https://www.free-css.com/free-css-templates/page287/dentcare'>Free-css Orjinal Template</a></li>
			<li>MySql</li>
			<li>Jquery</li>
			<li>Ajax</li>
      <li>Seo</li>
      <li>Çoklu Dil Desteği</li>
		</ul>
		Proje veritabanı diyagramı : <p>
		<img src="img/database.png" style="width:80%">
      </p>
      <div class="d-flex justify-content-center mt-5">



      </div>
    </div>
  </section>


  <!-- about section -->