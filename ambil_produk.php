<?php
include 'koneksi.php';

// Pastikan data bersih dari spasi
$m_id = trim($merchant_id);
$s_key = trim($secret_key);

// COBA RUMUS SESUAI DOKUMENTASI TERBARU (Mungkin perlu huruf kecil semua)
// Rumus: md5(MerchantID + SecretKey + "pr")
$signature = md5($m_id . $s_key . "pr");

// Endpoint URL
$url = "https://v1.apigames.id/merchant/produk?merchant=$m_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Tambah timeout agar tidak gantung
$result = curl_exec($ch);
curl_close($ch);

$data_produk = json_decode($result, true);

// CEK APAKAH ADA MASALAH PADA PENGIRIMAN DATA
if (isset($data_produk['status']) && $data_produk['status'] == 0) {
    echo "<div style='color:red; background:#fff3f3; padding:10px; border:1px solid red; border-radius:8px; margin-bottom:15px;'>";
    echo "<b>⚠️ Pesan Pusat:</b> " . $data_produk['error_msg'] . "<br>";
    echo "<small>Saran: Pastikan di Dashboard APIGames > Integrasi, IP Whitelist benar-benar KOSONG (tidak ada spasi/angka satu pun).</small>";
    echo "</div>";
}

// Fungsi filter produk
function getMLProducts($data) {
    $results = [];
    if(isset($data['data']) && is_array($data['data'])) {
        foreach($data['data'] as $p) {
            // Kita cari kategori Mobile Legends
            if(strpos(strtolower($p['kategori']), 'mobile legend') !== false) {
                $results[] = $p;
            }
        }
    }
    return $results;
}

$produk_ml = getMLProducts($data_produk);
?>
