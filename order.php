<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $sku     = $_POST['sku']; // SKU produk dari APIGames
    $ref_id  = "LIBAN-" . time(); // Membuat nomor referensi unik

    // 1. RUMUS SIGNATURE UNTUK TRANSAKSI (Sesuai dokumentasi APIGames)
    // Signature: md5(merchant_id + secret_key + ref_id)
    $signature = md5($merchant_id . $secret_key . $ref_id);

    // 2. URL TRANSAKSI APIGAMES
    $url = "https://v1.apigames.id/v2/transaksi";

    // 3. DATA YANG DIKIRIM
    $data_post = [
        'merchant'    => $merchant_id,
        'sku'         => $sku,
        'destination' => $user_id,
        'ref_id'      => $ref_id,
        'signature'   => $signature
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

    $respon = json_decode($result, true);

    echo "<div style='background:#121212; color:white; padding:30px; font-family:sans-serif; min-height:100vh;'>";
    
    if (isset($respon['status']) && $respon['status'] == 1) {
        // SIMPAN KE DATABASE LOKAL JIKA SUKSES
        $query = "INSERT INTO riwayat_order (target, layanan, status) VALUES ('$user_id', '$sku', 'Proses')";
        mysqli_query($conn, $query);

        echo "<h2 style='color:#00d166;'>✅ PESANAN BERHASIL TERKIRIM!</h2>";
        echo "<p>Pesanan Anda sedang diproses oleh sistem.</p>";
        echo "<hr style='border-color:#333;'>";
        echo "ID Transaksi: " . $respon['data']['trx_id'] . "<br>";
        echo "Status: " . $respon['data']['status'] . "<br>";
        echo "SN/Keterangan: " . $respon['data']['sn'];
    } else {
        echo "<h2 style='color:#ff4d4d;'>❌ PESANAN GAGAL</h2>";
        echo "Pesan: " . ($respon['message'] ?? 'Terjadi kesalahan sistem.');
        if(isset($respon['error_msg'])) echo "<br>Detail: " . $respon['error_msg'];
    }

    echo "<br><br><a href='index.php' style='color:#00d166; text-decoration:none;'>&laquo; Kembali ke Toko</a>";
    echo "</div>";
}
?>