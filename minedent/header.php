
<?php
include('baglan.php');
$sorgu_gnl = mysqli_query($conn,"select * from genel_bilgiler");
$genel_bilgiler = mysqli_fetch_array($sorgu_gnl);
$sayfa_param = @$_GET['sayfa'];
$sayfa_parts = explode('?', $sayfa_param);
$sayfa_id = $sayfa_parts[0];
?>
<base href="http://localhost/minedent/minedent/">
<html lang=<?php echo $dil ?> dir="<?php echo ($dil == 'ar') ? 'rtl' : 'ltr'; ?>">
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-primary me-2"></i><?php ml_yaz($dil,"Açılış Saatleri")?>: <?php ml_yaz($dil,"Pzt - Cum")?> : 08:00 - 20:00 , <?php ml_yaz($dil,"Cmt")?>: 09:00 - 13:00,<?php ml_yaz($dil,"Paz Kapalı")?>  </small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i><?php echo $genel_bilgiler['e-mail'] ?></p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i><?php echo $genel_bilgiler['telefon'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="anasayfa?<?php echo $dil?>" class="navbar-brand p-0">
            <h1 class="m-0 text-primary"><i class="fa fa-tooth me-2"></i><?php echo $genel_bilgiler['site_adi'] ?></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="anasayfa?<?php echo $dil?>" class="nav-item nav-link active"><?php ml_yaz($dil,"Ana Sayfa")?></a>
                <a href="hakkinda?<?php echo $dil?>" class="nav-item nav-link"><?php ml_yaz($dil,"Hakkımızda")?></a>
                <a href="hizmetler?<?php echo $dil?>" class="nav-item nav-link"><?php ml_yaz($dil,"Hizmetlerimiz")?></a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php ml_yaz($dil,"Sayfalar")?></a>
                    <div class="dropdown-menu m-0">
                        <a href="fiyatlar?<?php echo $dil?>" class="dropdown-item"><?php ml_yaz($dil,"Fiyatlandırmamız")?></a>
                        <a href="doktorlar?<?php echo $dil?>" class="dropdown-item"><?php ml_yaz($dil,"Diş Hekimlerimiz")?></a>
                    </div>
                </div>
                <a href="iletisim?<?php echo $dil?>" class="nav-item nav-link"><?php ml_yaz($dil,"İletişim")?></a>
            </div>
            <a href="randevu?<?php echo $dil?>" class="btn btn-primary py-2 px-4 ms-3"><?php ml_yaz($dil,"Randevu")?></a>
            
        </div>
        <div class="nav-item">
					<a class="nav-link" href="javascript:void(0)" src="img/earth.png" onclick="SelSiteLang()"><img class="w-80" src="img/earth.png" alt="Image"> </a>
					<div id="SelSiteLang" style="position:absolute; display:none; margin-left:0px; margin-top:0px; background-color:#1E90FF; z-index:999; opacity:0.80;">
						<div style="padding:15px 20px 15px 20px;">
						<?php if ($dil <> "tr") { ?> <div style="border-bottom:1px dotted #666666; padding:5px 0px 5px 0px;"><a href="<?php echo $sayfa_id ?>?tr" style="color:white;font-size:13px;">TÜRKÇE</a></div> <?php } ?>
						<?php if ($dil <> "ar") { ?> <div style="border-bottom:1px dotted #666666; padding:5px 0px 5px 0px;"><a href="<?php echo $sayfa_id ?>?ar" style="color:white;font-size:13px;">عربي</a></div> <?php } ?>
						<?php if ($dil <> "en") { ?> <div style="border-bottom:1px dotted #666666; padding:5px 0px 5px 0px;"><a href="<?php echo $sayfa_id ?>?en" style="color:white;font-size:13px;">ENGLISH</a></div> <?php } ?>
						<?php if ($dil <> "de") { ?> <div style="border-bottom:1px dotted #666666; padding:5px 0px 5px 0px;"><a href="<?php echo $sayfa_id ?>?de" style="color:white;font-size:13px;">DEUTSCH</a></div> <?php } ?>
						<?php if ($dil <> "fr") { ?> <div style="border-bottom:1px dotted #666666; padding:5px 0px 5px 0px;"><a href="<?php echo $sayfa_id ?>?fr" style="color:white;font-size:13px;">FRANÇAIS</a></div> <?php } ?>					
						</div>
					</div>				
					<script>
						function SelSiteLang()  {
							if ($('#SelSiteLang').css('display') == 'none') { 
									$('#SelSiteLang').css('display', 'block'); 
							} 
							else { 
									$('#SelSiteLang').css('display', 'none'); 
							}
						}
					</script>				
				</div>					
    </nav>