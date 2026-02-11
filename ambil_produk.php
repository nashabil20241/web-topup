<?php
include 'koneksi.php';

$m_id = trim($merchant_id);
$s_key = trim($secret_key);

// KITA COBA RUMUS STANDAR V2 (ID + KEY + "produk")
$signature = md5($m_id . $s_key . "produk");

$url = "https://v1.apigames.id/merchant/produk?merchant=$m_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_produk = json_decode($result, true);

// JIKA GAGAL, KITA COBA RUMUS VARIASI TITIK DUA (ID:KEY:produk)
if (isset($data_produk['status']) && $data_produk['status'] == 0) {
    $signature_v2 = md5($m_id . ":" . $s_key . ":produk");
    $url_v2 = "https://v1.apigames.id/merchant/produk?merchant=$m_id&signature=$signature_v2";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_v2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    $data_produk = json_decode($result, true);
}

// Fungsi filter produk Mobile Legends
function getMLProducts($data) {
    $results = [];
    if(isset($data['data']) && is_array($data['data'])) {
        foreach($data['data'] as $p) {
            // Filter kategori Mobile Legends
            if(strpos(strtolower($p['kategori']), 'mobile legend') !== false) {
                $results[] = $p;
            }
        }
    }
    return $results;
}

$produk_ml = getMLProducts($data_produk);
?>
