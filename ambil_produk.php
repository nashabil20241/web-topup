<?php
include 'koneksi.php';

$m_id = trim($merchant_id);
$s_key = trim($secret_key);

// SESUAI POSTMAN: Signature Ambil Produk adalah MD5(merchant + secret + "pr")
// PASTI KAN tidak ada tanda titik dua (:) di dalam MD5 ini
$signature = md5($m_id . $s_key . "pr");

// URL endpoint juga harus bersih
$url = "https://v1.apigames.id/merchant/produk?merchant=$m_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_produk = json_decode($result, true);

// Jika masih error, kita tampilkan detail untuk debugging
if (isset($data_produk['status']) && $data_produk['status'] == 0) {
    echo "<div style='color:red; padding:10px; border:1px solid red;'>";
    echo "<b>Error dari APIGames:</b> " . $data_produk['error_msg'] . "<br>";
    echo "<b>Merchant ID:</b> " . $m_id . "<br>";
    echo "</div>";
}

function getMLProducts($data) {
    $results = [];
    if(isset($data['data']) && is_array($data['data'])) {
        foreach($data['data'] as $p) {
            // Kita ambil kategori yang ada nama Mobile Legends
            if(strpos(strtolower($p['kategori']), 'mobile legend') !== false) {
                $results[] = $p;
            }
        }
    }
    return $results;
}

$produk_ml = getMLProducts($data_produk);
?>
