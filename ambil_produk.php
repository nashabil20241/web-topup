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

// INI PENYAKITNYA! URL SEKARANG SUDAH DIGANTI KE 'services'
$url = "https://vip-reseller.co.id/api/services"; 

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
$game_pilihan = isset($_GET['game']) ? strtolower(trim($_GET['game'])) : 'mobile legends';

if (isset($data_vip['data']) && is_array($data_vip['data'])) {
    foreach ($data_vip['data'] as $item) {
        // Cari nama kategori gamenya
        $brand = strtolower($item['brand'] ?? $item['category'] ?? $item['kategori'] ?? $item['game'] ?? '');
        
        // Cek apakah ini game yang dipilih user
        if (strpos($brand, 'mobile legend') !== false || strpos($brand, $game_pilihan) !== false) {
            $name = strtolower($item['name'] ?? '');
            
            // Filter ketat: Buang Joki, Pass, dan Twilight
            if (strpos($name, 'joki') === false && 
                strpos($name, 'twilight') === false && 
                strpos($name, 'pass') === false) {
                
                // Bersihkan tulisan Bonus dkk
                $clean_name = preg_replace('/(\+.*bonus.*|bonus.*|\(.*\))/i', '', $item['name'] ?? 'Tanpa Nama');
                $clean_name = trim($clean_name);

                if (!in_array($clean_name, $seen_names) && $clean_name != '') {
                    $item['name_clean'] = $clean_name;
                    $item['price'] = $item['price'] ?? $item['harga'] ?? 0;
                    $item['id'] = $item['id'] ?? $item['kode'] ?? '';
                    
                    $produk_ml[] = $item;
                    $seen_names[] = $clean_name;
                }
            }
        }
    }
}

// BONGKAR JAWABAN API JIKA MASIH KOSONG
if (empty($produk_ml)) {
    echo "<div class='alert alert-danger w-100'>";
    echo "<b>Pesan Server VIP:</b><br>";
    echo "<pre style='font-size:12px; background:#fff; padding:10px; border-radius:5px;'>" . htmlspecialchars($result) . "</pre>";
    echo "</div>";
}
?>
