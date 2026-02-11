<?php
include 'koneksi.php';

echo "<h2 style='font-family:sans-serif;'>Daftar Kategori Asli Medanpedia:</h2>";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url . "services");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "api_id=" . $api_id . "&api_key=" . $api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$respon = json_decode($result, true);

if (isset($respon['status']) && $respon['status'] == true) {
    $semua_kategori = [];
    foreach ($respon['data'] as $item) {
        $semua_kategori[] = $item['category']; // Ambil nama kategorinya saja
    }
    
    // Hilangkan nama kategori yang dobel
    $kategori_unik = array_unique($semua_kategori);
    sort($kategori_unik); // Urutkan sesuai abjad
    
    echo "<ol style='font-family:sans-serif; line-height:1.8;'>";
    foreach ($kategori_unik as $kat) {
        echo "<li><b>" . htmlspecialchars($kat) . "</b></li>";
    }
    echo "</ol>";
} else {
    echo "Koneksi ke API Gagal.";
}
?>