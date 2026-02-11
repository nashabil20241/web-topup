<?php
// Gunakan data terbaru yang sudah terbukti sukses di info akun
$merchant_id = "M260210CSXG7601QA"; 
$secret_key = "fe82a9adfea474e2ba25bd42f676cc5f478d84b2dd4bf9401e84dba24e4c6ef9"; 

// Rumus: ID + "produk" + KEY
// Rumus: ID + KEY + "produk" (Murni gabung)
$signature = md5($merchant_id . $secret_key . "produk");

// Endpoint Produk
$url = "https://v1.apigames.id/merchant/produk?merchant=$merchant_id&signature=$signature";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$respon = json_decode($result, true);

echo "<h3>Hasil Tes Daftar Produk:</h3>";
if (isset($respon['status']) && $respon['status'] == 1) {
    echo "<p style='color:green;'>✅ BERHASIL! Daftar produk ditemukan.</p>";
    echo "<pre>" . print_r($respon['data'][0], true) . "</pre>"; // Menampilkan contoh 1 produk
} else {
    echo "<p style='color:red;'>❌ GAGAL!</p>";
    echo "Pesan: " . ($respon['error_msg'] ?? 'Cek signature produk');
    echo "<br>Respon Mentah: $result";
}
?>