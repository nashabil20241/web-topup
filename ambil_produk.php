<?php
include 'koneksi.php';

// Menghapus spasi tak sengaja agar signature tidak rusak
$m_id = trim($merchant_id);
$s_key = trim($secret_key);

// RUMUS VARIASI BARU: MD5(merchant + secret + "produk")
$signature = md5($m_id . $s_key . "produk");

$url = "https://v1.apigames.id/merchant/produk?merchant=$m_id&signature=$signature";

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
            // Filter kategori yang mengandung 'Mobile Legend'
            if(strpos(strtolower($p['kategori']), 'mobile legend') !== false) {
                $results[] = $p;
            }
        }
    }
    return $results;
}

// Tampilkan error jika signature masih salah
if (isset($data_produk['status']) && $data_produk['status'] == 0) {
    echo "<div class='alert alert-danger'><b>Error API:</b> " . $data_produk['error_msg'] . "</div>";
    // Debugging untuk Mas (Hanya Mas yang lihat di source code)
    echo "";
}

$produk_ml = getMLProducts($data_produk);
?>
