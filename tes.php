<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DATA MAS
$merchant_id = "M260210CSXG7601QA"; 
$secret_key  = "656098db2294105be2aed7aefef8b1caa96668f9fd6a612d7c6ee1411dc9d049"; // Pastikan ini benar ya

$signature = md5($merchant_id . $secret_key);
$url = "https://v1.apigames.id/merchant/" . $merchant_id . "?signature=" . $signature;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data = json_decode($result, true);

echo "<h2 style='font-family:sans-serif; color:#00d166;'>✅ KONEKSI APIGAMES BERHASIL!</h2>";
echo "<div style='font-family:sans-serif; background:#1e1e1e; color:#fff; padding:20px; border-radius:12px; border:1px solid #333;'>";

if (isset($data['status']) && $data['status'] == 1) {
    echo "<b>Detail Akun Merchant:</b><br><hr style='border-color:#333;'>";
    echo "ID Merchant: " . $data['data']['merchant_id'] . "<br>";
    echo "Nama Pemilik: " . $data['data']['nama'] . "<br>";
    echo "Email: " . $data['data']['email'] . "<br>";
    echo "<h3 style='color:#00d166;'>Sisa Saldo: Rp " . number_format($data['data']['saldo'], 0, ',', '.') . "</h3>";
} else {
    echo "Gagal menarik data: " . ($data['message'] ?? 'Error');
}

echo "</div>";
?>