<?php
// File: api_vip.php
include 'koneksi.php';

$formData = [
    'api_id' => $api_id,
    'api_key' => $api_key,
];

// Endpoint VIP Reseller (Pastikan endpoint ini benar sesuai dokumentasi akun Mas)
$url = "https://vip-reseller.co.id/api/game-feature"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($formData));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_vip = json_decode($result, true);

// CEK ERROR: Jika gagal, ini akan menampilkan alasannya di web
if (!$data_vip || (isset($data_vip['result']) && $data_vip['result'] == false)) {
    $pesan_error = isset($data_vip['message']) ? $data_vip['message'] : "Koneksi API Gagal";
    echo "<div class='alert alert-danger m-3'><b>Pesan dari VIP Reseller:</b> " . $pesan_error . "</div>";
    // Tampilkan data mentah untuk dicek
    echo ""; 
}
?>
