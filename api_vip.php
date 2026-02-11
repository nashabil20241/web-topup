<?php
// File: api_vip.php
include 'koneksi.php';

// Pastikan tidak ada spasi yang nyangkut
$id = trim($api_id);
$key = trim($api_key);

// Kita masukkan semua kemungkinan parameter yang diminta VIP Reseller
$formData = [
    'api_id'  => $id,
    'api_key' => $key,
    'key'     => $key,
    'sign'    => md5($id . $key), // Beberapa sistem VIP minta format sign MD5
    'type'    => 'services'
];

$url = "https://vip-reseller.co.id/api/game-feature"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
// PERBAIKAN PENTING: Kita kirim array mentah agar jadi 'multipart/form-data'
curl_setopt($ch, CURLOPT_POSTFIELDS, $formData); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_vip = json_decode($result, true);

// CEK ERROR
if (!$data_vip || (isset($data_vip['result']) && $data_vip['result'] == false)) {
    $pesan_error = isset($data_vip['message']) ? $data_vip['message'] : "Koneksi API Gagal";
    echo "<div class='alert alert-danger m-3'><b>Pesan dari VIP Reseller:</b> " . $pesan_error . "</div>";
    // Debugging rahasia buat Mas
    echo ""; 
}
?>
