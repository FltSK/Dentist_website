<?php
include_once('editor_fonks.php');
include_once('editor_ses_kontrol.php');
	
	
?>
	<?php
			$sorgu_doktor = mysqli_query($conn,"select * from doktorlar");
            $satir_doktor = mysqli_fetch_array($sorgu_doktor);
            $sorgu_uzmanlik = mysqli_query($conn,"select uzmanlık from doktorlar");
            $sorgu_uzmanliklar = mysqli_query($conn, "SELECT DISTINCT uzmanlık FROM doktorlar");
	?>
                <!-- Begin Page Content -->
   <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Randevu Alma</h1>
    <div class="card-body">
        <div class="table-responsive">
            <form id='randevu_bilgileri' name='randevu_bilgileri' method="post" enctype="multipart/form-data" action="isle.php?islem=randevu_alma">
                <table class="table table-bordered" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><strong>Uzmanlık Alanı Seçin</strong></td>
                        <td>
                            <select name="uzmanlik_alani" id="uzmanlik_alani" required onchange="getDoctors()">
                                <option value="">Uzmanlık Alanı Seçin</option>
                                <?php 
                                
                                while ($satir_uzmanlik = mysqli_fetch_array($sorgu_uzmanliklar)) {
                                    echo "<option value='{$satir_uzmanlik['uzmanlık']}'>{$satir_uzmanlik['uzmanlık']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Doktor Seçin</strong></td>
                        <td>
                            <select name="doktor_adi" id="doktor_adi" required>
                                <option value="" disabled selected>Önce uzmanlık alanını seçin</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Randevu Tarihi</strong></td>
                        <td>
                            <input type="date" id="randevu_tarihi" name="randevu_tarihi" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+14 days')); ?>" required onchange="getHours()">
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Randevu Saati</strong></td>
                        <td>
                            <select name="randevu_saati" id="randevu_saati" required>
                            <option value="">Tarih Seçin</option>
                            </select>
                        </td>
                    </tr>
                    <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
                <td style="text-align:left; vertical-align: middle;">
                <input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Randevu Al'>
                </td>
                </tr>
                </table>
            </form>
        </div>
    </div>
</div>


  <script>
  // ajax    
  $('form#randevu_bilgileri').submit(function(event) {
    event.preventDefault(); 
		$('#sonuc').fadeIn().html("<img src=admin_img/l.gif width=24 height=24 valign='middle'>");
    var form = $(this);
    var formVeri= new FormData($('form#randevu_bilgileri')[0]);   
    var randevu_saat_value = document.getElementById("randevu_saati").value;
    if(randevu_saat_value===-1){
        alert("Dolu");
        return;
    }
    
    
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
<script>
    document.getElementById('randevu_tarihi').addEventListener('change', function() {
        var selectedDate = new Date(this.value);
        if (selectedDate.getDay() === 0) { // 0: Pazar
            alert("Pazar günü randevu alınamaz. Lütfen başka bir gün seçin.");
            this.value = ''; // Tarihi sıfırla
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function getDoctors() {
        // console.log("hello");
        var uzmanlik_alani = document.getElementById("uzmanlik_alani").value;
        var doktor_adi_select = document.getElementById("doktor_adi");

        // Temizleme: Her seçim değiştiğinde, önceki doktor listesini temizle
        doktor_adi_select.innerHTML = '<option value="">Yükleniyor...</option>';

        // AJAX ile doktorları almak için bir istek yapın
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_doctors.php?uzmanlik_alani=" + uzmanlik_alani, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                // Gelen yanıtı işleyin ve doktorları <select> içine yerleştirin
                doktor_adi_select.innerHTML = response;
            }
        };
        xhr.send();
    }
</script>

<script>
function getHours() {
    var doktor_adi = document.getElementById("doktor_adi").value;
    var randevu_tarih = document.getElementById("randevu_tarihi").value;
    var randevu_saat_select = document.getElementById("randevu_saati");
    // console.log("d_id:" + doktor_adi + " randevu tarihi:" + randevu_tarih);
    // Temizleme: Her tarih seçiminde, önceki saat listesini temizle
    randevu_saat_select.innerHTML = '<option value="">Yükleniyor...</option>';

    // AJAX ile randevu saatlerini almak için bir istek yapın
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_randevu.php?doktor_adi=" + doktor_adi + "&tarih=" + randevu_tarih, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                // Gelen yanıtı işleyin ve randevu saatlerini <select> içine yerleştirin
                randevu_saat_select.innerHTML = '<option value="">Randevu Saati Seçin</option>';
                console.log(response);
                if (response && typeof response === 'object' && Object.keys(response).length > 0) {
                    Object.values(response).forEach(function (saat) {
                        randevu_saat_select.innerHTML += '<option value="' + saat + '">' + saat + '</option>';
                    });
                } else {
                    // Eğer response boşsa veya dizi değilse
                    randevu_saat_select.innerHTML = '<option value="-1">Dolu</option>';
                }
            } catch (e) {
                console.error("JSON parse hatası: ", e);
                randevu_saat_select.innerHTML = '<option value="-1">Bir hata oluştu</option>';
            }
        }
    };
    xhr.onerror = function() {
        console.error("AJAX isteğinde bir hata oluştu.");
        randevu_saat_select.innerHTML = '<option value="-1">Bir hata oluştu</option>';
    };
    xhr.send();
}


</script>






