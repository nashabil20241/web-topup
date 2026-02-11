<?php
include 'koneksi.php';

// Rumus Signature untuk Produk
$signature = md5($merchant_id . ":" . $secret_key . ":produk");
$url = "https://v1.apigames.id/merchant/produk?merchant=$merchant_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_produk = json_decode($result, true);

// Fungsi filter produk Mobile Legends
function getMLProducts($data) {
    $results = [];
    if(isset($data['data']) && is_array($data['data'])) {
        foreach($data['data'] as $p) {
            // Mengambil yang ada kata 'Mobile Legend' tapi bukan yang 'Member' atau 'Joki'
            if(strpos(strtolower($p['kategori']), 'mobile legend') !== false) {
                $results[] = $p;
            }
        }
    }
    return $results;
}

$produk_ml = getMLProducts($data_produk);
?>
