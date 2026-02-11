<?php
include 'koneksi.php';

$signature = md5($merchant_id . ":" . $secret_key . ":produk");
$url = "https://v1.apigames.id/merchant/produk?merchant=$merchant_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Penting untuk Railway
$result = curl_exec($ch);
curl_close($ch);

$data_produk = json_decode($result, true);

if (isset($data_produk['status']) && $data_produk['status'] == 0) {
    // Kalau error, tampilkan pesannya di web agar kita tahu salahnya di mana
    echo "<p style='color:red;'>Error API: " . $data_produk['error_msg'] . "</p>";
}

function getMLProducts($data) {
    $results = [];
    if(isset($data['data'])) {
        foreach($data['data'] as $p) {
            // Kita filter agar hanya menampilkan Mobile Legends
            if(strpos(strtolower($p['kategori']), 'mobile legend') !== false) {
                $results[] = $p;
            }
        }
    }
    return $results;
}

$produk_ml = getMLProducts($data_produk);
?>
