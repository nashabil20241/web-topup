<?php
// Masukkan data Mas di sini
$merchant_id = "M260210CSXG7601QA"; 
$secret_key  = "fe82a9adfea474e2ba25bd42f676cc5f478d84b2dd4bf9401e84dba24e4c6ef9"; 

// 1. Buat Signature (Wajib pakai titik dua)
$signature = md5($merchant_id . ":" . $secret_key);

// 2. Susun URL sesuai link yang Mas kasih
$url = "https://v1.apigames.id/merchant/" . $merchant_id . "?signature=" . $signature;

// 3. Eksekusi
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

echo "<h3>Hasil Tes Endpoint Info Akun:</h3>";
echo "<pre>$result</pre>";
?>