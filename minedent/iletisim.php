<!DOCTYPE html>
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn"><?php ml_yaz($dil,"Bize Ulaşın")?></h1>
                <a href="" class="h4 text-white"><?php ml_yaz($dil,"Ana Sayfa")?></a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h4 text-white"><?php ml_yaz($dil,"İletişim")?></a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                <div class="contact-form">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase"><?php ml_yaz($dil,"Bizimle İletişime Geçin")?></h5>
                            <h1 class="display-6 mb-4"><?php ml_yaz($dil,"Bizimle iletişime geçmekten çekinmeyin")?></h1>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0"><?php ml_yaz($dil,"Kliniğimiz")?></h5>
                                <span>Libadiye, İstanbul, TR</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0"><?php ml_yaz($dil,"Bize Email Gönderin")?></h5>
                                <span>medident@gmail.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0"><?php ml_yaz($dil,"Bizi Arayın")?></h5>
                                <span>+212 450 45 45</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-xl-4 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                <div class="contact-form">
                    <form id='iletisim_formu' action="islemler.php">
                        <div class="row g-3">
                            <div class="col-12">
                                <input name=ad_soyad required type="text" class="form-control border-0 bg-light px-4" placeholder="<?php ml_yaz($dil,"Adınız Ve Soyadınız")?>" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input name=mail required type="email" class="form-control border-0 bg-light px-4" placeholder="<?php ml_yaz($dil,"e-Postanız")?>" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input name=tel required pattern="[0-9]{11}" class="form-control border-0 bg-light px-4" placeholder="<?php ml_yaz($dil,"Telefon Numaranız")?>:0555 555 55 55" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea name='mesaj' required type="text" class="form-control border-0 bg-light px-4 py-3" rows="5" placeholder="<?php ml_yaz($dil,"Mesajınız")?>"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit"><?php ml_yaz($dil,"GÖNDER")?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			  <div id='sonuc' style='margin: auto;'>  </div> 
            </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/twentytwenty/jquery.event.move.js"></script>
    <script src="lib/twentytwenty/jquery.twentytwenty.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script> 
  $("#iletisim_formu").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var actionUrl = form.attr('action');
    
    $.ajax({
        type: "GET",
        url: actionUrl,
        data: form.serialize() + '&islem=iletisim', 
        success: function(data)
        {
          $('#sonuc').html(data);
		  $('.contact-form').hide();
        }
    });
    
});
</script>