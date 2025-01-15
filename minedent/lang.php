<?php
// URL'deki son parçayı çek
$url = $_SERVER['REQUEST_URI'];
$parts = explode('?', $url);

$dil = 'tr'; // Varsayılan dil Türkçe
$dil_secenekleri = array('tr', 'en', 'ar', 'de', 'fr');

if (count($parts) > 1) {
    $potential_dil = $parts[1];
    if (in_array($potential_dil, $dil_secenekleri)) {
        $dil = $potential_dil;
    }
}

// Dil değerini ekrana yazdır (debug için)

?>


<!-- <console class="log"><?php echo $dil ?></console> -->
