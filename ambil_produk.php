<?php
include 'koneksi.php';

$id = trim($api_id);
$key = trim($api_key);

$formData = [
    'api_id'  => $id,
    'api_key' => $key,
    'key'     => $key,
    'sign'    => md5($id . $key),
    'type'    => 'services'
];

$url = "https://vip-reseller.co.id/api/game-feature"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

$data_vip = json_decode($result, true);

$produk_ml = [];
$seen_names = [];

if (isset($data_vip['data']) && is_array($data_vip['data'])) {
    foreach ($data_vip['data'] as $item) {
        // JURUS INTEL: Jadikan seluruh data item ini sebuah teks, lalu cari kata 'mobile legend'
        $item_string = strtolower(json_encode($item));
        
        if (strpos($item_string, 'mobile legend') !== false) {
            // Ambil nama (biasanya VIP pakai 'name')
            $name = strtolower($item['name'] ?? '');
            
            // Filter: Buang Joki, Twilight, Pass
            if (strpos($name, 'joki') === false && 
                strpos($name, 'twilight') === false && 
                strpos($name, 'pass') === false) {
                
                // Bersihkan tulisan Bonus dll
                $clean_name = preg_replace('/(\+.*bonus.*|bonus.*|\(.*\))/i', '', $item['name'] ?? 'Tanpa Nama');
                $clean_name = trim($clean_name);

                if (!in_array($clean_name, $seen_names) && $clean_name != '') {
                    $item['name_clean'] = $clean_name;
                    
                    // Antisipasi nama harga dan id dari VIP
                    $item['price'] = $item['price'] ?? $item['harga'] ?? 0;
                    $item['id'] = $item['id'] ?? $item['kode'] ?? '';
                    
                    $produk_ml[] = $item;
                    $seen_names[] = $clean_name;
                }
            }
        }
    }
}

// JIKA MASIH KOSONG: Bongkar isi data pertama agar kita tahu persis format dari VIP
if (empty($produk_ml) && isset($data_vip['data'][0])) {
    echo "<div class='alert alert-warning w-100'>";
    echo "<b>Koneksi Sukses, tapi nama kategori beda. Ini isi data aslinya:</b><br>";
    echo "<pre style='font-size:12px; background:#fff; padding:10px; border-radius:5px;'>" . htmlspecialchars(print_r($data_vip['data'][0], true)) . "</pre>";
    echo "</div>";
} elseif (empty($produk_ml)) {
    echo "<div class='alert alert-danger w-100'>Data dari VIP Reseller benar-benar kosong atau API belum aktif penuh.</div>";
}
?>
